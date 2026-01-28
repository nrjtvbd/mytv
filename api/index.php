<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/vnd.apple.mpegurl");

// ১. সোর্স থেকে টি-স্পোর্টসের আসল লিঙ্কটি সংগ্রহ করা
$source = file_get_contents("http://mrgifytv.pages.dev/bpl/tsports/index.m3u8");
preg_match('/https?:\/\/[^\s]+/', $source, $matches);

if (isset($matches[0])) {
    $stream_url = trim($matches[0]);

    // ২. ইনসিকিউর সার্ভার থেকে ডেটা আনার জন্য কন্টেক্সট তৈরি করা
    $opts = [
        "ssl" => [
            "verify_peer" => false,
            "verify_peer_name" => false,
        ],
        "http" => [
            "header" => "User-Agent: AynaOTT/1.2.1\r\nReferer: https://aynaott.com/\r\n"
        ]
    ];
    $context = stream_context_create($opts);

    // ৩. ভিডিও ডাটা রিড করে সরাসরি অ্যাপে পাঠিয়ে দেওয়া
    $data = file_get_contents($stream_url, false, $context);
    
    if ($data !== false) {
        echo $data;
    } else {
        // যদি ডাটা রিড করতে না পারে, তবে রিডাইরেক্ট করার শেষ চেষ্টা করা
        header("Location: " . $stream_url);
    }
}
?>

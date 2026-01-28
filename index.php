<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/vnd.apple.mpegurl");

$context = stream_context_create([
    "ssl" => ["verify_peer" => false, "verify_peer_name" => false],
    "http" => ["header" => "User-Agent: AynaOTT/1.2.1\r\nReferer: https://aynaott.com/\r\n"]
]);

// এটি আপনার হোস্টিং আইপি ব্যবহার করে সরাসরি লিঙ্কটি জেনারেট করবে
$data = file_get_contents("http://mrgifytv.pages.dev/bpl/tsports/index.m3u8", false, $context);
preg_match('/https?:\/\/[^\s]+/', $data, $matches);

if (isset($matches[0])) {
    // রিডাইরেক্ট করলে টোকেন মিসম্যাচ হয়, তাই সরাসরি প্রক্সি আউটপুট দিবে
    echo file_get_contents($matches[0], false, $context);
}
?>

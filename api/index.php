<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/vnd.apple.mpegurl");

// ১. সোর্স থেকে লিঙ্ক সংগ্রহ
$source = file_get_contents("http://mrgifytv.pages.dev/bpl/tsports/index.m3u8");
preg_match('/https?:\/\/[^\s]+/', $source, $matches);

if (isset($matches[0])) {
    $tsports_url = trim($matches[0]);
    
    // ২. সরাসরি ডাটা রিড করে আউটপুট দেয়া (অ্যাপের জন্য সবচেয়ে কার্যকর)
    $opts = [
        "http" => [
            "header" => "User-Agent: AynaOTT/1.2.1\r\nReferer: https://aynaott.com/\r\n"
        ],
        "ssl" => ["verify_peer"=>false, "verify_peer_name"=>false]
    ];
    $context = stream_context_create($opts);
    echo file_get_contents($tsports_url, false, $context);
} else {
    echo "Stream Not Found";
}
?>

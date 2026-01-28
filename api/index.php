<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/vnd.apple.mpegurl");

function get_data($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'AynaOTT/1.2.1');
    curl_setopt($ch, CURLOPT_REFERER, 'https://aynaott.com/');
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

// ১. সোর্স থেকে লিঙ্ক সংগ্রহ
$source = get_data("http://mrgifytv.pages.dev/bpl/tsports/index.m3u8");
preg_match('/https?:\/\/[^\s]+/', $source, $matches);

if (isset($matches[0])) {
    // ২. সরাসরি লিঙ্কটি রিডাইরেক্ট করে দেখা (Vercel-এ এটিই সবচেয়ে বেশি কাজ করে)
    header("Location: " . trim($matches[0]));
    exit;
} else {
    echo "Stream Not Found";
}
?>

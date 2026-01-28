<?php
// ১. সোর্স থেকে টি-স্পোর্টসের লেটেস্ট লিঙ্ক আনা
$source = file_get_contents("http://mrgifytv.pages.dev/bpl/tsports/index.m3u8");
preg_match('/https?:\/\/[^\s]+/', $source, $matches);

if (isset($matches[0])) {
    $final_url = trim($matches[0]);
    
    // ২. রিডাইরেক্ট করার সময় হেডার সেট করা
    header("Access-Control-Allow-Origin: *");
    header("Location: " . $final_url);
    header("X-Forwarded-For: " . $_SERVER['REMOTE_ADDR']);
    exit;
} else {
    echo "Live link not found at source.";
}
?>

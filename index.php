<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/vnd.apple.mpegurl");

$ctx = stream_context_create([
    "ssl" => ["verify_peer" => false, "verify_peer_name" => false],
    "http" => ["header" => "User-Agent: Mozilla/5.0\r\nReferer: https://aynaott.com/\r\n"]
]);

$content = file_get_contents("http://mrgifytv.pages.dev/bpl/tsports/index.m3u8", false, $ctx);
preg_match('/https?:\/\/[^\s]+/', $content, $matches);

if (isset($matches[0])) {
    echo file_get_contents($matches[0], false, $ctx);
}
?>

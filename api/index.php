<?php
$source = file_get_contents("http://mrgifytv.pages.dev/bpl/tsports/index.m3u8");
preg_match('/https?:\/\/[^\s]+/', $source, $matches);
if (isset($matches[0])) {
    header("Location: " . trim($matches[0]));
    exit;
}
?>

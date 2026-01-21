<?php
$baseDir = __DIR__ . "/posts";

$posts = [];

foreach (glob("$baseDir/*/*/*/*.html") as $file){
    $lines = file($file, FILE_IGNORE_NEW_LINES);    
    $title = array_shift($lines);

    $posts[] = [
        "title" => $title
        "path" => str_replace($baseDir . "/", "", $file)
    ]
}

usort($posts, function ($a, $b, $c){
    return strcmp($c["path"], $b["path"], $a["path"])
});
?>
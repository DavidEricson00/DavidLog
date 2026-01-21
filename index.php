<?php
ini_set("display_errors", 0);
error_reporting(0);

$baseDir = __DIR__ . "/posts";

$posts = [];

foreach (glob("$baseDir/*/*/*/*.html") as $file){
    $lines = file($file, FILE_IGNORE_NEW_LINES);    
    $title = array_shift($lines);

    $posts[] = [
        "title" => $title,
        "path" => str_replace($baseDir . "/", "", $file)
    ];
}

usort($posts, function ($a, $b, $c){
    return strcmp($c["path"], $b["path"], $a["path"]);
});
?>

<!DOCTYPE html>
<html lang = "pt-br">
<head>
    <meta charset="utf-8">
    <title>DavidLog</title>
</head>
<body>
<h1>DavidLog</h1>

<ul>
<?php
    foreach($posts as $post)
?>
    <li>
        <a href="post.php?p=<?= urlencode($post["path"]) ?>">
            <?= htmlspecialchars($post["title"]) ?>
        </a>
    </li>
</ul>
</body>
</html>
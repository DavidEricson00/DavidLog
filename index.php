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
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>DavidLog</title>
</head>
<body>
    <header>
        <h1 class="site-title">DavidLog</h1>
        <h3 class="site-subtitle">Bom dia :)</h3>
    </header>

    <ul class="post-list">
        <?php foreach ($posts as $post): ?>
            <li>
                <a class="post-link" href="post.php?p=<?= urlencode($post["path"]) ?>">
                    <?= htmlspecialchars($post["title"]) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
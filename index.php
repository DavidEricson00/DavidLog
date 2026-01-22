<?php
ini_set("display_errors", 0);
error_reporting(0);

$baseDir = __DIR__ . "/posts";

$posts = [];

foreach (glob("$baseDir/*/*/*/*.html") as $file) {
    $relativePath = str_replace($baseDir . "/", "", $file);
    $parts = explode("/", $relativePath);

    [$year, $month, $day] = array_slice($parts, 0, 3);

    $lines = file($file, FILE_IGNORE_NEW_LINES);
    $title = array_shift($lines);

    $posts[] = [
        "title" => $title,
        "path" => $relativePath,
        "date" => "$day/$month/$year"
    ];
}

usort($posts, function ($a, $b) {
    return strcmp($b["path"], $a["path"]);
});
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css?v=<?= filemtime(__DIR__ . "/style.css") ?>">
    <link rel="icon" href="icon.png?v=<?= filemtime(__DIR__ . '/icon.png') ?>" type="image/png">
    <title>DavidLog</title>
</head>
<body>
    <header>
        <h1 class="site-title">DavidLog</h1>
        <h3 class="site-subtitle">Bom dia :)</h3>
    </header>

    <ul class="post-list">
        <?php foreach ($posts as $post): ?>
            <li class="post-item">
                <a class="post-link" href="post.php?p=<?= urlencode($post["path"]) ?>">
                    <?= htmlspecialchars($post["title"]) ?>
                </a>
                <p class="post-date"><?= $post["date"] ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

    <footer class="site-footer">
        <div class="social-links">
            <a href="https://github.com/DavidEricson00" target="_blank" rel="noopener">
                GitHub
            </a>
            <a href="https://www.linkedin.com/in/davidericson00/" target="_blank" rel="noopener">
                LinkedIn
            </a>
            <a href="https://davidericson00.itch.io" target="_blank" rel="noopener">
                Itch.io
            </a>
        </div>
    </footer>
</body>
</html>
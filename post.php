<?php
ini_set("display_errors", 0);
error_reporting(0);

$baseDir = __DIR__ . "/posts";

$post = $_GET["p"] ?? "";

$path = realpath("$baseDir/$post");

if (
    !$path ||
    strpos($path, realpath($baseDir)) !== 0
) {
    die("Post não encontrado :(");
}
if (!str_ends_with($path, ".html")) {
    die("Arquivo inválido");
}
if (filesize($path) > 1024 * 1024) {
    die("Post muito grande");
}

$relativePath = str_replace(realpath($baseDir) . DIRECTORY_SEPARATOR, "", $path);
$parts = explode(DIRECTORY_SEPARATOR, $relativePath);

[$year, $month, $day] = array_slice($parts, 0, 3);

$postDate = "$day/$month/$year";

$lines = file($path, FILE_IGNORE_NEW_LINES);
$title = array_shift($lines);
$content = implode("\n", $lines);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= filemtime(__DIR__ . "/style.css") ?>">
    <link rel="icon" href="icon.png?v=<?= filemtime(__DIR__ . '/icon.png') ?>" type="image/png">
    <link rel="canonical"
      href="https://davidericson00.page.gd/post.php?p=<?= urlencode($relativePath) ?>">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>

    <div class="container">
        <a class="back-link" href="index.php">← Voltar</a>

        <header class="site-header post-header">
            <h1 class="site-title small">DavidLog</h1>
            <div class="separator"></div>
            <p class="post-meta-date"><?= $postDate ?></p>
            <h2 class="post-title"><?= htmlspecialchars($title) ?></h2>
        </header>

        <article class="post-content">
            <?= $content ?>
        </article>

        <footer class="site-footer">
            <div class="separator small"></div>
            <nav class="social-links">
                <a href="https://github.com/DavidEricson00" target="_blank" rel="noopener">GitHub</a>
                <span class="divider">/</span>
                <a href="https://www.linkedin.com/in/davidericson00/" target="_blank" rel="noopener">LinkedIn</a>
                <span class="divider">/</span>
                <a href="https://davidericson00.itch.io" target="_blank" rel="noopener">Itch.io</a>
            </nav>
        </footer>
    </div>
</body>
</html>
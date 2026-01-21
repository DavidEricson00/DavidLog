<?php
$baseDir = __DIR__ . "/posts";

$post = $_GET["p"] ?? "";

$path = realpath("$baseDir/$post");

if (
    !$path ||
    strpos($path, realpath($baseDir)) !== 0
) {
    die("Post não encontrado :(");
}

$lines = file($path, FILE_IGNORE_NEW_LINES);
$title = array_shift($lines);
$content = implode("\n", $lines);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title)?></title>
</head>
<body>
    <a href="index.php">←Voltar</a>
    <h1><?= htmlspecialchars($title)?></h1>
    <?=$content?>
</body>
</html>
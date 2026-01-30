<?php
header("Content-Type: application/xml; charset=UTF-8");

$baseUrl = "https://davidericson00.page.gd";
$baseDir = __DIR__ . "/posts";

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Home
echo '<url>';
echo '<loc>' . $baseUrl . '/</loc>';
echo '<priority>1.0</priority>';
echo '</url>';

// Posts
foreach (glob("$baseDir/*/*/*/*.html") as $file) {
    $relativePath = str_replace($baseDir . "/", "", $file);
    $encodedPath = urlencode($relativePath);

    echo '<url>';
    echo '<loc>' . $baseUrl . '/post.php?p=' . $encodedPath . '</loc>';
    echo '<priority>0.8</priority>';
    echo '</url>';
}

echo '</urlset>';

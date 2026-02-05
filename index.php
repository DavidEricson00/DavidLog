<?php
ini_set("display_errors", 0);
error_reporting(0);

$baseDir = __DIR__ . "/posts";

$posts = [];

$subtitles = [
    "Bom dia :)",
    "Boa tarde :/",
    "Boa noite :(",
    "O blog legal",
    "Jogue rapadura clicker!",
    "100% profissional",
    "._.",
    "DavidBlog",
    "O melhor da minha rua!",
    "Coding",
    "Melhor deixar pra amanhã",
    "Pensamentos não intrusivos",
    "Na minha cabeça faz muito sentido",
    "Tem alguem lendo isso aqui?",
    "Olá Mundo",
    "Hello World",
    "Um texto em uma tela",
    "Olá internet",
    "Penso logo escrevo",
    "Artesanal",
    "01101111 01101001",
    "Conteúdo de qualidade",
    "Duvidoso",
    "Melhor que nada",
    ".io",
    "DavidLog",
    "DLC em desenvolvimento",
    "Agora em web",
    "Maior blog da minha rua",
    "Ideia 100% orignal",
    "Free Host",
    "Acabou as ideias",
    "Na minha opinião",
    "Caixa chinesa",
    "Maior fã de Turing",
    "Bits and Bytes",
    'lang="pt-br"',
    "É tudo uma simulação",
    "Feito com autocomplete",
    "O sentido da vida é",
    "42",
    "LogDavid",
    "Melhor que nada",
    "Demo Day!",
    "Pitch",
    "Um monte de 1 e 0",
    "Ideia nova",
    "Brasil",
    "Foi divertido",
    "Foi bom enquanto durou",
    ":0",
    ":D",
    ":)",
    ":(",
    "Nota de repúdio",
    "Ouça João Gilberto",
    "O melhor que eu ja vi",
    "Sem glútem",
    "Family friendly",
    "Relatable",
    "Lorem ipsum dolor sit amet",
    "Também disponível em Catalão",
    "Agora eu to sem ideias",
    "Deploy",
    "Versão 1.0",
    "Não fume. É estrume.",
    "Não recomendado em caso de suspeita de dengue",
    "Totalmente revisado",
    "Sem falhas",
    "Sem vírus",
    "100% Seguro",
    "Erro 404, brincadeira :D",
    "HaHa",
    "Uma coleção de insetos",
    "Só funciona se o actions rodar",
    "Pixel",
    "Interface",
    "Volte sempre",
    "Não volte",
    "Desculpa aí qualquer coisa",
    "A ideia era boa, a execução nem tanto",
    "Tem como piorar?",
    "Não sei mais o que colocar aqui",
    "Tudo tende ao caos",
    "Agente ou a gente?",
    "Gentileza gera gentileza",
    "Obrigado!",
];

$subtitle = $subtitles[array_rand($subtitles)];

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
    <header class="site-header">
        <h1 class="site-title">DavidLog</h1>
        <h3 class="site-subtitle">
            <?= htmlspecialchars($subtitle) ?>
        </h3>
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
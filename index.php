<?php

function asset($file)
{
    $file = "assets/$file";
    $version = md5(filemtime($file));
    return "$file?assetVersion=$version";
}

$meta =  [
    'title' => 'Glowie | Powerful and lightweight PHP framework',
    'description' => 'Glowie is a PHP framework designed to be as light, fast and powerful as possible for developing applications and dynamic websites the easiest way',
    'url' => 'https://glowie.gabrielsilva.dev.br',
    'image' => 'https://glowie.gabrielsilva.dev.br/assets/images/ogicon.png',
    'keywords' => 'php, development, framework, programming, website, application, api, toolkit',
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= asset('images/favicon.png') ?>">
    <title><?= $meta['title'] ?></title>

    <meta name="title" content="<?= $meta['title'] ?>">
    <meta name="description" content="<?= $meta['description'] ?>">
    <meta name="author" content="Gabriel Silva">
    <meta name="keywords" content="<?= $meta['keywords'] ?>">
    <meta name="robots" content="index,follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $meta['url'] ?>">
    <meta property="og:title" content="<?= $meta['title'] ?>">
    <meta property="og:description" content="<?= $meta['description'] ?>">
    <meta property="og:image" content="<?= $meta['image'] ?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:image:width" content="256">
    <meta property="og:image:height" content="256">
    <meta property="og:site_name" content="Glowie">
    <meta property="twitter:card" content="summary">
    <meta property="twitter:title" content="<?= $meta['title'] ?>">
    <meta property="twitter:description" content="<?= $meta['description'] ?>">
    <meta property="twitter:image" content="<?= $meta['image'] ?>">
    <meta property="twitter:image:width" content="256">
    <meta property="twitter:image:height" content="256">
    <meta name="color-scheme" content="dark light">

    <link rel="stylesheet" href="https://eugabrielsilva.github.io/shadstrap/dist/shadstrap.min.css">
    <link rel="stylesheet" href="<?= asset('css/dist/glowie.min.css') ?>">
</head>

<body>
    <header>
        <div class="menu">
            <a class="btn btn-link" href="./">Home</a>
            <a class="btn btn-link" href="./docs">Documentation</a>
            <a class="btn btn-link" href="https://github.com/glowieframework" target="_blank">GitHub</a>
            <a class="btn btn-link" href="https://github.com/glowieframework/glowie/discussions" target="_blank">Support</a>
        </div>
    </header>

    <section class="hero">
        <h1 class="logo">glowie</h1>

        <h2 class="typewritter">The only web framework <br> you'll ever need.</h2>

        <div class="code single-line">
            <code><span class="text-muted">$</span> <span id="code">composer create-project glowieframework/glowie</span></code>
            <button class="btn btn-ghost btn-copy position-relative" data-ss-copy="#code" data-ss-tooltip="Copy">
                <i class="far fa-clipboard"></i>
            </button>
        </div>

        <div class="flex mt-4">
            <a href="./docs" class="btn">Documentation</a>
            <a href="https://github.com/glowieframework/glowie" target="_blank" class="btn btn-outline">GitHub</a>
        </div>
    </section>

    <footer>
        <div class="copyright">
            <p class="text-secondary">
                Proudly developed by <a href="https://gabrielsilva.dev.br" target="_blank">Gabriel Silva</a>.
            </p>
        </div>
    </footer>

    <script src="https://eugabrielsilva.github.io/shadstrap/dist/shadstrap.min.js"></script>
    <script src="<?= asset('js/dist/glowie.min.js') ?>"></script>
</body>

</html>
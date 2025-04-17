<?php
function asset($file)
{
    $file = "assets/$file";
    $version = md5(filemtime($file));
    return "$file?assetVersion=$version";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, user-scalable=no, maximum-scale=1.0, initial-scale=1.0">
    <title>Glowie | Powerful and lightweight PHP framework</title>

    <link rel="shortcut icon" href="<?= asset('images/favicon.png') ?>">
    <meta name="viewport" content="width=device-width, height=device-height, user-scalable=no, initial-scale=1">
    <meta name="title" content="Glowie | Powerful and lightweight PHP framework">
    <meta name=" description" content="Glowie is a PHP framework designed to be as light, fast and powerful as possible for developing applications and dynamic websites the easiest way">
    <meta name="keywords" content="php, development, framework, programming, website, application, api, toolkit">
    <meta name="robots" content="index,follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://glowie.gabrielsilva.dev.br">
    <meta property="og:title" content="Glowie | Powerful and lightweight PHP framework">
    <meta property="og:description" content="Glowie is a PHP framework designed to be as light, fast and powerful as possible for developing applications and dynamic websites the easiest way">
    <meta property="og:image" content="https://glowie.gabrielsilva.dev.br/assets/images/ogicon.png">
    <meta name="color-scheme" content="dark light">

    <link rel="stylesheet" href="<?= asset('css/shadstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>

<body>
    <header>
        <div class="menu">
            <a class="btn btn-link" href="./">Home</a>
            <a class="btn btn-link" href="./docs" target="_blank">Documentation</a>
            <a class="btn btn-link" href="https://github.com/glowieframework" target="_blank">GitHub</a>
            <a class="btn btn-link" href="https://github.com/glowieframework/glowie/discussions" target="_blank">Support</a>
        </div>
    </header>

    <section class="screen-centered hero">
        <img src="<?= asset('images/logo-dark.png') ?>" class="logo">

        <h1>The only web framework <br> you'll ever need.</h1>

        <code>
            <span>$</span> composer create-project glowieframework/glowie

            <button class="btn btn-ghost btn-copy">
                <i class="far fa-clipboard"></i>
            </button>
        </code>

        <div class="flex mt-4">
            <a href="./docs" target="_blank" class="btn">Documentation</a>
            <a href="https://github.com/glowieframework/glowie" target="_blank" class="btn btn-outline">GitHub</a>
        </div>
    </section>

    <section class="copyright">
        <p class="text-secondary">
            Proudly developed by <a href="https://gabrielsilva.dev.br" target="_blank">Gabriel Silva</a>.
        </p>
    </section>

    <script src="<?= asset('js/script.js') ?>"></script>
</body>

</html>
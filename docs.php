<?php
    $page = 'docs';
    $lastVersion = 'v1.0';

    // Get current docs version from URL
    if(empty($_GET['version'])){
        $version = $lastVersion;
    }else{
        $version = trim(strtolower($_GET['version']));
    }

    // Get docs route
    if(empty($_GET['route'])){
        $file = "documentation/{$version}/home.md";
    }else{
        $file = trim(strtolower($_GET['route']));
        $file = "documentation/{$version}/{$file}.md";
    }

    // Get documentation content
    if(!file_exists($file)) header('Location: https://glowie.tk/404');
    $content = file_get_contents($file);
    $menu = file_get_contents("documentation/{$version}/menu.md");
    $title = str_replace('# ', '', strtok($content, "\n"));

    // Get version list
    $versionList = glob('documentation/*', GLOB_ONLYDIR);

    // Parse content
    require_once 'includes/Parsedown.php';
    $Parsedown = new Parsedown();
    $Parsedown->setBreaksEnabled(true);
    $content = str_replace('##VERSION##', $version, $Parsedown->text($content));
    $menu = str_replace('##VERSION##', $version, $Parsedown->text($menu));
?>
<html>
    <head>
        <title><?=$title?> | Glowie Documentation</title>
        <?php include 'includes/head.php';?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/default.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/github.min.css">
    </head>
    <body>
        <?php include 'includes/header.php';?>
        <main>
            <?php include 'includes/docs-header.php';?>
            <section class="docs">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-9">
                            <?=$content; ?>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="menu">
                                <?=$menu; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/highlight.min.js"></script>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>
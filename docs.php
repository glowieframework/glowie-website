<?php
    $page = 'docs';

    // Gets the version list and latest version
    $versionList = glob('documentation/*', GLOB_ONLYDIR);
    $lastVersion = str_replace('documentation/', '', end($versionList));

    // Gets the URL version
    if(!empty($_GET['version']) && $_GET['version'] != 'latest'){
        $version = trim(strtolower($_GET['version']));
    }else{
        $version = $lastVersion;
    }

    // Gets the URL route
    if(empty($_GET['route'])){
        $file = "documentation/{$version}/home.md";
    }else{
        $file = trim(strtolower($_GET['route']));
        $file = "documentation/{$version}/{$file}.md";
    }

    // Gets docs content
    if(!file_exists($file)) header('Location: https://gabrielsilva.dev.br/glowie/404');
    $content = file_get_contents($file);
    $menu = file_get_contents("documentation/{$version}/_menu.md");
    $title = str_replace('# ', '', strtok($content, "\n"));

    // Parses the content
    require_once 'includes/lib/bootstrap.php';
    $parser = new ParsedownToC([
        'selectors' => ['h2', 'h3', 'h4', 'h5', 'h6'],
        'url' => $_SERVER['REQUEST_URI']
    ]);
    $content = str_replace('%%version%%', $version, $parser->text($content));
    $menu = str_replace('%%version%%', $version, $parser->body($menu));
?>
<html>
    <head>
        <title><?=$title?> | Glowie Documentation</title>
        <?php include 'includes/head.php';?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/default.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/github.min.css" id="hljs-light">
        <link rel="stylesheet" disabled href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/github-dark.min.css" id="hljs-dark">
    </head>
    <body>
        <?php include 'includes/header.php';?>
        <main>
            <?php include 'includes/docs-header.php';?>
            <section class="docs">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 col-xl-9">
                            <?=$content; ?>
                        </div>
                        <div class="col-12 col-lg-4 col-xl-3 mt-4 mt-lg-0">
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
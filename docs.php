<?php
    $page = 'docs';
    include 'includes/Parsedown.php';
    $Parsedown = new Parsedown();
    $Parsedown->setBreaksEnabled(true);
    if(empty($_GET['route'])){
        $file = 'documentation/home.md';
    }else{
        $file = 'documentation/' . trim(strtolower($_GET['route'])) . '.md';
        if(!file_exists($file)) header('Location: https://glowie.tk/docs');
    }
    $content = file_get_contents($file);
    $menu = file_get_contents('documentation/menu.md');
    $title = str_replace('# ', '', strtok($content, "\n"));
?>
<html>
    <head>
        <title><?=$title?> | Glowie Framework Documentation</title>
        <?php include 'includes/head.php';?>
    </head>
    <body>
        <?php include 'includes/header.php';?>
        <main>
            <?php include 'includes/docs-header.php';?>
            <section class="docs">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-9">
                            <?=str_replace(['<pre><code class="language-php">', '<pre><code class="language-html">'], ['<pre><code class="prettyprint language-php">', '<pre><code class="prettyprint language-php">'], $Parsedown->text($content)); ?>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="menu">
                                <?=str_replace('<p>﻿</p>', '', $Parsedown->text($menu)); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>
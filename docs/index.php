<?php
    $page = 'docs';
    include '../includes/Parsedown.php';
    $Parsedown = new Parsedown();
    $Parsedown->setBreaksEnabled(true);
    if(empty($_GET['route'])){
        $file = 'source/home.md';
    }else{
        $file = 'source/' . trim(strtolower($_GET['route'])) . '.md';
        if(!file_exists($file)){
            $file = 'source/home.md';
        }
    }
    $content = file_get_contents($file);
?>
<html>
    <head>
        <title>Documentation | Glowie Framework</title>
        <?php include '../includes/head.php';?>
    </head>
    <body>
        <?php include '../includes/header.php';?>
        <?php include '../includes/docs-header.php';?>
        <section class="docs">
            <div class="container">
                <?=str_replace(['<pre><code class="language-php">', '<pre><code class="language-html">'], ['<pre><code class="prettyprint language-php">', '<pre><code class="prettyprint language-php">'], $Parsedown->text($content)); ?>
            </div>
        </section>
        <?php include '../includes/footer.php'; ?>
        <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
    </body>
</html>
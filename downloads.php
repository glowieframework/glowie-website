<?php 
    $page = 'downloads';
    $root = $_SERVER['DOCUMENT_ROOT'];
    $filePath = dirname(__FILE__);
?>
<html>
    <head>
        <title>Downloads | Glowie</title>
        <?php include 'includes/head.php';?>
    </head>
    <body>
        <?php include 'includes/header.php';?>
        <main>
            <section class="downloads">
                <div class="container">
                    <h1>Downloads</h1>
                    <div class="row">
                        <div class="col-12 col-md-6 align-items-stretch">
                            <div class="box">
                                <h3>Glowie <strong>(Stable)</strong></h3>
                                Stable version is coming soon.<br><br>
                                <a href="docs/getting-started/installation" class="link">&bull; Install guide</a><br>
                                <a href="https://github.com/glowieframework/glowie/issues" target="_blank" class="link">&bull; Report bugs</a><br>
                                <a class="download disabled">Coming soon</a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="box">
                                <h3>Glowie <strong>(Development)</strong></h3>
                                Current version <strong>dev-main</strong> for PHP <strong>7.4.9</strong> or higher.<br><br>
                                <a href="docs/getting-started/installation" class="link">&bull; Install guide</a><br>
                                <a href="https://github.com/glowieframework/glowie/issues" target="_blank" class="link">&bull; Report bugs</a><br>
                                <a href="https://github.com/glowieframework/glowie/archive/main.zip" target="_blank" class="download">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="downloads-changelog">
                <div class="container">
                    <h1>Changelog</h1>
                    <h4>dev-main</h4>
                    &bull; Initial development release
                </div>
            </section>
        </main>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>
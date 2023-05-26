<?php
require_once '../includes/lib/bootstrap.php';
$parser = new ParsedownToC();
$content = $parser->text(file_get_contents('docs.md'));
?>

<html>

<head>
    <title>Reactables by Glowie</title>
    <base href="<?= '/' . trim(dirname($_SERVER['PHP_SELF']), '/\\') . '/'; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/atom-one-dark.min.css">
    <link rel="stylesheet" href="reactables.css">
    <meta name="viewport" content="width=device-width, height=device-height, user-scalable=no, initial-scale=1">
    <meta name="robots" content="index,follow">
    <link rel="shortcut icon" href="favicon-react.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <div class="container">
        <header>
            <div class="row align-items-center">
                <div class="col-md-3">
                    <img src="reactables.png" class="logo">
                </div>
                <div class="col-md-9">
                    <h3>Glowie dynamic view components plugin</h3>
                    <pre>composer require glowieframework/glowie-reactables</pre>
                </div>
            </div>
        </header>
        <main>
            <?= $content ?>
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/highlight.min.js"></script>
    <script>
        hljs.highlightAll();
    </script>
</body>

</html>
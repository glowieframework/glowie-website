<?php 
    $page = 'home'; 
    $lastVersion = 'v1.0';
?>
<html>
    <head>
        <title>Glowie | Powerful and lightweight PHP framework</title>
        <?php include 'includes/head.php';?>
    </head>
    <body>
        <?php include 'includes/header.php';?>
        <main>
            <section class="index-banner">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-6">
                            <h1 id="typewriter"></h1>
                            <h5>Glowie is a PHP framework designed to be as light, fast and powerful as possible for developing applications and dynamic
                            websites the easiest way.</h5>
                            <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Fast and easy to setup</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Active updates</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Tiny blueprint</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Flexible and scalable</li>
                            </ul>
                            <a class="button" href="docs/<?=$lastVersion ?>/getting-started/installation">Get Started</a>
                            <a class="button docs" href="docs">Documentation</a>
                        </div>
                        <div class="col-12 col-lg-6 img-banner">
                            <img src="assets/images/banner.png?updateVersion=2405" class="bg">
                            <img src="assets/images/anim1.png" class="anim1">
                            <img src="assets/images/anim2.png" class="anim2">
                            <img src="assets/images/anim3.png" class="anim3">
                            <img src="assets/images/anim4.png" class="anim4">
                            <a class="attrib" href="http://www.freepik.com">Designed by pikisuperstar / Freepik</a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="index-separator">
                <div class="container">
                    <h1>Only what you need</h1>
                    <h5>Forget about those fancy frameworks with thousands of useless functions and classes with stuff you will never use.
                    Glowie is packed with only what you need for your application to run smoothly.</h5>
                    <div class="row mt-3 mt-lg-5">
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <a href="docs/<?=$lastVersion ?>/basic-application-modules/routes">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fas fa-route"></i>
                                        Routing engine
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <a href="docs/<?=$lastVersion ?>/forms-and-data/working-with-databases">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fas fa-database"></i>
                                        Database ORM
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <a href="docs/<?=$lastVersion ?>/forms-and-data/data-validation">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fas fa-check-circle"></i>
                                        Data validation
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <a href="docs/<?=$lastVersion ?>/extra/file-uploads">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        File uploader
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mt-lg-4">
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <a href="docs/<?=$lastVersion ?>/basic-application-modules/middlewares">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fas fa-lock"></i>
                                        Middlewares
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <a href="docs/<?=$lastVersion ?>/extra/mail">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fas fa-envelope"></i>
                                        Mail sender
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <a href="docs/<?=$lastVersion ?>/getting-started/app-configuration">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fas fa-project-diagram"></i>
                                        Multiple environments
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <a href="docs/<?=$lastVersion ?>/extra/firefly">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fas fa-terminal"></i>
                                        Command line utility
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mt-lg-4">
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <a href="docs/<?=$lastVersion ?>/extra/http-requests">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fas fa-globe-americas"></i>
                                        HTTP requests
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <a href="docs/<?=$lastVersion ?>/extra/internationalization">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fas fa-language"></i>
                                        Internationalization
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <a href="docs/<?=$lastVersion ?>/forms-and-data/session">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fas fa-users"></i>
                                        Session management
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <a href="docs/<?=$lastVersion ?>/extra/skeltch">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="fas fa-code"></i>
                                        Templating engine
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="index-separator background">
                <div class="container text-center">
                    <h1>Ready to create something awesome?</h1>
                    <h5>You are a few steps from the best programming experience you'll ever have.</h5>
                    <a class="button" href="docs/<?=$lastVersion ?>/getting-started/installation">Get Started</a>
                    <a class="button docs" href="docs">Documentation</a>
                </div>
            </section>
        </main>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>
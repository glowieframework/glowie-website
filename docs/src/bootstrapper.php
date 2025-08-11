<?php

/*
    ----------------------------------------------------------
    ButterDocs bootstrapper
    ----------------------------------------------------------
    This file imports and starts the ButterDocs application.
    We do not recommend editing this or the app may break.
    ----------------------------------------------------------
*/

// Include helpers
require_once(__DIR__ . '/core/_helpers.php');

// Include dependencies
require_once(__DIR__ . '/core/Parsedown.php');
require_once(__DIR__ . '/core/ParsedownExtra.php');
require_once(__DIR__ . '/core/ParsedownExtended.php');

// Include ButterDocs core
require_once(__DIR__ . '/core/ButterDocs.php');

// Include the global configuration file
$config = require_once(__DIR__ . '/../config.php');

// Unleash ButterDocs!
$app = new ButterDocs($config);
$app->unleash();

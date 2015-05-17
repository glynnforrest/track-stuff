<?php

use Neptune\Core\Neptune;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/Application.php';

$neptune = new Neptune(__DIR__.'/..');
$env = require __DIR__.'/../app/env.php';
$neptune->setEnv($env);
// $neptune->enableCache();

if ($env === 'development') {
    $whoops = new \Whoops\Run();
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
    $whoops->register();
}

$app = new \Application();
$app->start($neptune);

$neptune->go();

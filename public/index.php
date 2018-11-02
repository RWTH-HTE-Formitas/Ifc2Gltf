<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();
$app->get('/ifcToGltf', \WebIfc\Controller::class . ':ifcToGltf');
$app->run();

<?php

require __DIR__ . '/../vendor/autoload.php';

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new \Slim\App($config);
$app->get('/ifcToGltf', \WebIfc\Controller::class . ':ifcToGltf');
$app->run();

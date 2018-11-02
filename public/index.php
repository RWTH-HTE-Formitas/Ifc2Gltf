<?php

require __DIR__ . '/../vendor/autoload.php';

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new \Slim\App($config);
$app->get('/ifcToGltf', \Ifc2Gltf\Controller::class . ':ifcToGltf');
$app->run();

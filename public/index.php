<?php

require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../config.php';
$container = new \WebIfc\Container($config);

$app = new \Slim\App($container);
$app->get('/project-{projectId}/scene.gltf', \WebIfc\Controller::class . ':noteScene');
$app->run();

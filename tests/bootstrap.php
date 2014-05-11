<?php

ini_set('error_reporting', E_ALL);

// installed itself
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    $autoloder = require __DIR__ . '/../vendor/autoload.php';

// installed as dependency
} elseif (file_exists(__DIR__ . '/../../../autoload.php')) {
    $autoloder = require __DIR__ . '/../../../autoload.php';

// not installed
} else {
    echo "Can not find autoload.php - please run \"composer install\"", PHP_EOL;
    exit(1);
}

/** @var $autoloder \Composer\Autoload\ClassLoader */
$autoloder->addPsr4('DvLab\\DeploymentBuildsExecutor\\', array('vendor/dv-affection/deployment-builds-executor/src'));
$autoloder->addPsr4('DvLab\\DeploymentBuildsExecutorBundle\\', array('src', 'tests'));

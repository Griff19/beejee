<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

$config = array_merge(
    require 'app/config/params.php',
    require 'app/config/local.php'
);

(new griff\App($config))->run();

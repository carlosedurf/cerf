<?php

use CERF\Router\Router;

require_once __DIR__ . "/vendor/autoload.php";

// Load .ENV
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

Router::loadRouter();

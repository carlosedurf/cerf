<?php

$baseDir = __DIR__ . "/";

$files = scandir($baseDir); // Load helpers folder
array_shift($files); // remove . helpers folder
array_shift($files); // remove .. helpers folder

foreach ($files as $file) {
    if ($file !== "index.php") {
        require_once $baseDir . $file;
    }
}
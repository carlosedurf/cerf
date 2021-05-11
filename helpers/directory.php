<?php

function config($nameConfig) {
    $args = include __DIR__ . "/../config/{$nameConfig}.php";
    return $args;
}
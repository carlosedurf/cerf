<?php

namespace CERF\Router;

class Router
{
    public static function loadRouter()
    {
        $typeRouter = getenv('ROUTER_MANUAL');

        if ($typeRouter) {
            RouterAutomatic::run();
        }
    }
}

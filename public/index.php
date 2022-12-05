<?php
mb_internal_encoding("UTF-8");

function autoLoadFunction($class): void
{
    if(str_ends_with($class, 'Controller')) {
        require ("../core/controllers/" . $class . ".php");
    } else {
        require ("../core/models/" . $class . ".php");
    }
}

spl_autoload_register("autoLoadFunction");
$router = new RouterController();
$router->process(array($_SERVER['REQUEST_URI']));
$router->renderView();

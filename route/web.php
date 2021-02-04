<?php

use Route\Router;

$router = new Router();
$router->add('', ['controller' => 'AccountController', 'action' => 'show']);
$router->add('account?{id}', ['controller' => 'AccountController', 'action' => 'showAccount']);

$router->dispatch($_SERVER['QUERY_STRING']);
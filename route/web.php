<?php

use Route\Router;

$router = new Router();
$router->add('', ['controller' => 'AccountController', 'action' => 'show']);
$router->add('account?{id}', ['controller' => 'AccountController', 'action' => 'showAccount']);
//$router->add('account', ['controller' => 'AccountController', 'action' => 'showAccount']); // тоже самое

$router->dispatch($_SERVER['QUERY_STRING']);
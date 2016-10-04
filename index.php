<?php

//Front controller

//config
ini_set('display_errors',1);
error_reporting(E_ALL);

//require resources
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Autoload.php');

//starting session
session_start();

//call router
$router = new Router();
$router->run();

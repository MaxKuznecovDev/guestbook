<?php
namespace core;
use core\mvc\View;

use project\controllers\PageController;

/*
|
|Here we are connecting Composer and configuration files
|
*/
require_once "vendor/autoload.php";
require_once "project/config/const.php";
require_once "project/config/connection_db.php";
require_once "project/config/dateset.php";




error_reporting(E_ALL);
ini_set('display_errors', 'on');

/*
|
| Run The Application
|
*/

$routes = require_once CONFIG.'/routes.php';

$router = new Router();

$track  = $router->getTrack($routes, $_SERVER['REQUEST_URI']);

$page  = ( new Dispatcher ) -> getPage($track);
echo (new View) -> render($page);

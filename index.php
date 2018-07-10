<?php 
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;

$app = new Slim();

require_once('routers/site.php');
require_once('routers/admin.php');
require_once('routers/admin-users.php');
require_once('routers/admin-categories.php');
require_once('routers/admin-products.php');

$app->run();
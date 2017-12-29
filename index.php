<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Database
require_once('connection.php');

if(isset($_GET['controller'], $_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    // Default page
    $controller = 'pages';
    $action = 'home';
}

require_once('views/routes.php');
$routes = new Route($controller, $action);
$routes->call();
$routes->display();

?>
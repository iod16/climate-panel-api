<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

use AltoRouter;

$router = new AltoRouter();

require __DIR__ . '/Routes/routes.php';

$match = $router->match();

if ($match) {
    $controller = $match['target'];
    $params = $match['params'];

    if (is_callable($controller)) {
        echo call_user_func_array($controller, $params);
    } else {
        echo "404 Not Found";
    }
} else {
    echo "404 Not Found";
}
<?php
declare(strict_types=1);

use src\Database;
use src\ProductController;
use src\ProductGateway;

spl_autoload_register(function ($class){
    require __DIR__ . "\\$class.php";
});
set_error_handler("src\\ErrorHandler::handleError");
set_exception_handler("src\\ErrorHandler::handleException");

header("Content-type: application/json; charset=UTF-8");

$parts = explode("/",$_SERVER['REQUEST_URI']);

if ($parts[1] != 'products'){
    http_response_code(404);
    exit;
}

$id = $parts[2] ?? null;
$database = new Database('localhost', 3307, 'product_db', 'root','root');
//$database->getConnection();
$gateway = new ProductGateway($database);
$controller = new ProductController($gateway);

$controller->processRequest($_SERVER["REQUEST_METHOD"], $id);
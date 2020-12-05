<?php

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\UserController;
use LMVC\Database\MySQLConnection;
use LMVC\Http\Request;
use LMVC\Http\Response;
use LMVC\Http\Route;
use LMVC\Http\Router;
use LMVC\Http\Url;

$connection = new MySQLConnection('localhost', 'muhsin', 'secret', 'lmvc', 3306);
$connection->connect();

$router = new Router();
$router->set('users.index', new Route(new Url('/users'), 'get', UserController::class, 'index'));
$router->set('users.create', new Route(new Url('/users/create'), 'get', UserController::class, 'create'));
$router->set('users.store', new Route(new Url('/users'), 'post', UserController::class, 'store'));

function debug($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function abort(int $code, string $status = ''): Response {
    $content = "<h1 style='color: red;'>${code} ${status}</h1>";

    return new Response($content, $code, $status);
}

$request = Request::createFromGlobals();
$request->getServer()->set('REQUEST_ROUTE', $request->getQuery()->get('route', '/'));

$response = $router->handle($request);

$response->send();
$connection->disconnect();

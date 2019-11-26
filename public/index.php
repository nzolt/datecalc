<?php
session_set_cookie_params(3600);
session_start();
// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

use Josantonius\Session\Session;
use Bramus\Router\Router;
use Nette\Http\RequestFactory;
use App\Controller\IndexController;
use Jenssegers\Blade\Blade;

const APIKEY = '4932aebe-0eef-11ea-8f7b-e4a7a06ef9c4';

// Create Request instance
$factory = new RequestFactory;
$request = $factory->fromGlobals();
$csrft = $request->getPost('csrf');
// Create Router instance
$router = new Router();
// Define routes authentication
$router->before('POST', '/oldhours', function() use($csrft) {
    if (Session::get('CSRFT') != $csrft) {
        Nette\Http\Response::S403_FORBIDDEN;
        header('HTTP/1.1 403 Unauthorized');
        exit();
    }
});
$router->before('GET|POST', '/api/oldhours', function() use($request) {
    if ($request->getHeader('X-API-Key') != APIKEY) {
        Nette\Http\Response::S403_FORBIDDEN;
        header('HTTP/1.1 403 Unauthorized');
        exit();
    }
});
// Create template engine
$blade = new Blade(__DIR__ . '/../views', 'cache');
// Define routes
$router->get('/', function() {
    echo 'Welcome!<br/> <a href="/oldhours">Get hours</a>';
});
$controller = new IndexController();
$router->setNamespace('\App\Controllers');
$router->get('/oldhours', function () use($controller, $blade) {
    echo $blade->make('list', $controller->index())->render();
});
$router->post('/oldhours', function () use($controller, $blade) {
    echo $blade->make('list', $controller->process())->render();
});
// Define API routes
$router->match('GET|POST','/api/oldhours', function () use($controller) {
    echo json_encode($controller->process());
});
// Run it!
$router->run();
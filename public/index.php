<?php
// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

use Josantonius\Session\Session;
use Bramus\Router\Router;
use Nette\Http\RequestFactory;
use App\Controller\IndexController;
use Jenssegers\Blade\Blade;

// Create Request instance
$factory = new RequestFactory;
$request = $factory->fromGlobals();
$csrft = $request->getPost('csrf');
// Create template
$blade = new Blade(__DIR__ . '/../views', 'cache');
// Create Router instance
$router = new Router();
// Define routes
$router->before('POST', '/oldhours', function() use($csrft) {
    //var_dump(Session::get('CSRFT'), $csrft);
    if (Session::get('CSRFT') != $csrft) {
        Nette\Http\Response::S403_FORBIDDEN;
        header('HTTP/1.1 403 Unauthorized');
        exit();
    }
});
$router->get('/', function() {
    echo 'Welcome!<br/> <a href="/oldhours">Get hours</a>';
});
$controller = new IndexController();
$router->setNamespace('\App\Controllers');
$router->get('/oldhours', function () use($controller, $blade) {
    echo $blade->make('list', $controller->index())->render();
});
$router->post('/oldhours', function () use($controller, $blade) {
    //die(var_dump($controller->process()));
    echo $blade->make('list', $controller->process())->render();
});
// Run it!
$router->run();
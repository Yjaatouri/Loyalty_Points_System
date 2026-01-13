<?php


session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Config/database.php'; 
require_once __DIR__ . '/../src/Routing/Router.php';
require_once __DIR__ . '/../src/Services/Container.php';


$container = new Container();
$container->set('db', getDbConnection());
$container->set('twig', new \Twig\Environment(new \Twig\Loader\FilesystemLoader(__DIR__ . '/../src/Views'), [
    'cache' => false, 
]));


$router = new Router($container);


$router->get('/', 'DashboardController::index'); 
$router->get('/register', 'AuthController::showRegister');
$router->post('/register', 'AuthController::register');
$router->get('/login', 'AuthController::showLogin');
$router->post('/login', 'AuthController::login');
$router->get('/logout', 'AuthController::logout');
$router->get('/dashboard', 'DashboardController::index');
$router->get('/points/history', 'PointsController::history');
$router->get('/rewards', 'RewardsController::browse');
$router->post('/rewards/redeem/{id}', 'RewardsController::redeem');


$router->get('/shop', 'GoodsController::index');
$router->post('/shop/buy/{id}', 'GoodsController::buy');

// Dispatch request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
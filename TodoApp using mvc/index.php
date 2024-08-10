<?php

require_once './core/Autoloader.php';

use Core\Router;
use App\controllers\SiteController;

define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('APP_PATH', ROOT_PATH . 'app' . DIRECTORY_SEPARATOR);
define('CONTROLLERS_PATH', APP_PATH . 'controllers' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', APP_PATH . 'views' . DIRECTORY_SEPARATOR);
define('LAYOUTS_PATH', VIEWS_PATH . 'layouts'. DIRECTORY_SEPARATOR);

$router = new Router();

$router->get('/', [SiteController::class, 'home']);
$router->get('/about', [SiteController::class, 'about']);

$router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

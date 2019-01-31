<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

global $capsule;

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);


use Illuminate\Database\Capsule\Manager AS DB;




$capsule = new DB();
$capsule->addConnection( [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'prueba_inventario',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

require __DIR__ . '/../src/models/Categoria.php';
require __DIR__ . '/../src/models/Producto.php';
require __DIR__ . '/../src/models/EntradaInventario.php';

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();

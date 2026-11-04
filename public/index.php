<?php
require __DIR__ . '/autoload.php';

use App\Controllers\ProductController;
use App\Database;
use App\Repositories\ProductRepository;
use App\Services\ProductService;

$repository = new ProductRepository(Database::connection());
$service = new ProductService($repository);
$controller = new ProductController($service);

match ($_GET['action'] ?? 'index') {
    'edit'   => $controller->edit(),
    'delete' => $controller->delete(),
    default  => $controller->index(),
};

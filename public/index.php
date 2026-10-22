<?php
require __DIR__ . '/autoload.php';

use App\Controllers\ProductController;
use App\Database;
use App\Repositories\ProductRepository;
use App\Services\ProductService;

$repository = new ProductRepository(Database::connection());
$service = new ProductService($repository);

(new ProductController($service))->index();
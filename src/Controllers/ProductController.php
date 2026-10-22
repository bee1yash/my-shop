<?php
namespace App\Controllers;

use App\Services\ProductService;
use App\Services\ValidationException;

final class ProductController
{
    public function __construct(private ProductService $service) {}

    public function index(): void
    {
        $error = null;
        $old = ['sku' => '', 'name' => '', 'price' => '', 'quantity' => '0'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->service->create($_POST);
                header('Location: index.php');
                exit;
            } catch (ValidationException $e) {
                $error = $e->getMessage();
                $old = array_merge($old, $_POST);
            }
        }

        $products = $this->service->list();
        require dirname(__DIR__) . '/Views/products_list.php';
    }
}
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
                $this->redirect('index.php');
            } catch (ValidationException $e) {
                $error = $e->getMessage();
                $old = array_merge($old, $_POST);
            }
        }

        $this->render('products_list', [
            'title' => 'Облік товарів',
            'products' => $this->service->list(),
            'error' => $error,
            'old' => $old,
        ]);
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        try {
            $product = $this->service->get($id);
        } catch (ValidationException $e) {
            $this->redirect('index.php');
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->service->update($id, $_POST);
                $this->redirect('index.php');
            } catch (ValidationException $e) {
                $error = $e->getMessage();
                $product = array_merge($product, $_POST); 
            }
        }

        $this->render('product_edit', [
            'title' => 'Редагувати товар',
            'product' => $product,
            'error' => $error,
        ]);
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->service->delete((int) ($_POST['id'] ?? 0));
            } catch (ValidationException $e) {
            }
        }
        $this->redirect('index.php');
    }

    private function render(string $view, array $data): void
    {
        extract($data);
        $e = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
        require dirname(__DIR__) . '/Views/' . $view . '.php';
    }

    private function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}

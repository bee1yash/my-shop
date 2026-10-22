<?php
namespace App\Services;

use App\Repositories\ProductRepository;

final class ProductService
{
    public function __construct(private ProductRepository $products) {}

    public function list(): array
    {
        return $this->products->all();
    }

    public function create(array $input): void
    {
        $sku = trim((string) ($input['sku'] ?? ''));
        $name = trim((string) ($input['name'] ?? ''));
        $price = $input['price'] ?? '';
        $quantity = $input['quantity'] ?? 0;

        if ($sku === '') {
            throw new ValidationException('Артикул (SKU) обов\'язковий');
        }
        if ($name === '') {
            throw new ValidationException('Назва товару обов\'язкова');
        }
        if (!is_numeric($price) || (float) $price < 0) {
            throw new ValidationException('Ціна має бути невід\'ємним числом');
        }
        if (!is_numeric($quantity) || (int) $quantity < 0) {
            throw new ValidationException('Кількість має бути невід\'ємним цілим числом');
        }
        if ($this->products->findBySku($sku) !== null) {
            throw new ValidationException("Товар з артикулом «{$sku}» вже існує");
        }

        $this->products->create($sku, $name, round((float) $price, 2), (int) $quantity);
    }
}
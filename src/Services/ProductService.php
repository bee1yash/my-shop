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

    public function get(int $id): array
    {
        $product = $this->products->find($id);
        if ($product === null) {
            throw new ValidationException('Товар не знайдено');
        }
        return $product;
    }

    public function create(array $input): void
    {
        $data = $this->validate($input);

        if ($this->products->findBySku($data['sku']) !== null) {
            throw new ValidationException("Товар з артикулом «{$data['sku']}» вже існує");
        }

        $this->products->create($data['sku'], $data['name'], $data['price'], $data['quantity']);
    }

    public function update(int $id, array $input): void
    {
        $this->get($id); // перевірка, що товар існує
        $data = $this->validate($input);

        // SKU має бути унікальним, але власний SKU товару конфліктом не є
        $existing = $this->products->findBySku($data['sku']);
        if ($existing !== null && (int) $existing['id'] !== $id) {
            throw new ValidationException("Товар з артикулом «{$data['sku']}» вже існує");
        }

        $this->products->update($id, $data['sku'], $data['name'], $data['price'], $data['quantity']);
    }

    public function delete(int $id): void
    {
        $this->get($id);
        $this->products->delete($id);
    }

    /** Спільна валідація для створення й редагування. */
    private function validate(array $input): array
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

        return [
            'sku' => $sku,
            'name' => $name,
            'price' => round((float) $price, 2),
            'quantity' => (int) $quantity,
        ];
    }
}

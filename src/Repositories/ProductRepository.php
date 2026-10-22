<?php
namespace App\Repositories;

use PDO;

final class ProductRepository
{
    public function __construct(private PDO $db) {}

    public function all(): array
    {
        return $this->db->query('SELECT * FROM products ORDER BY id DESC')->fetchAll();
    }

    public function findBySku(string $sku): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE sku = :sku');
        $stmt->execute(['sku' => $sku]);
        return $stmt->fetch() ?: null;
    }

    public function create(string $sku, string $name, float $price, int $quantity): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO products (sku, name, price, quantity) VALUES (:sku, :name, :price, :quantity)'
        );
        $stmt->execute(compact('sku', 'name', 'price', 'quantity'));
    }
}
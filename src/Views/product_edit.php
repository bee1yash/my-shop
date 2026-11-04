<?php require __DIR__ . '/partials/header.php'; ?>

    <h3>Редагувати товар</h3>
    <?php if ($error): ?><div class="error"><?= $e($error) ?></div><?php endif; ?>
    <form method="post" action="index.php?action=edit&amp;id=<?= (int) $product['id'] ?>">
        <input name="sku" placeholder="SKU" value="<?= $e($product['sku']) ?>">
        <input name="name" placeholder="Назва" value="<?= $e($product['name']) ?>">
        <input name="price" type="number" step="0.01" min="0" placeholder="Ціна" value="<?= $e($product['price']) ?>">
        <input name="quantity" type="number" min="0" placeholder="Кількість" value="<?= $e($product['quantity']) ?>">
        <button type="submit">Зберегти</button>
        <a href="index.php">Скасувати</a>
    </form>


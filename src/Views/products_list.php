<?php require __DIR__ . '/partials/header.php'; ?>

    <h3>Додати товар</h3>
    <?php if ($error): ?><div class="error"><?= $e($error) ?></div><?php endif; ?>
    <form method="post">
        <input name="sku" placeholder="SKU" value="<?= $e($old['sku']) ?>">
        <input name="name" placeholder="Назва" value="<?= $e($old['name']) ?>">
        <input name="price" type="number" step="0.01" min="0" placeholder="Ціна" value="<?= $e($old['price']) ?>">
        <input name="quantity" type="number" min="0" placeholder="Кількість" value="<?= $e($old['quantity']) ?>">
        <button type="submit">Додати</button>
    </form>

    <table>
        <tr><th>SKU</th><th>Назва</th><th>Ціна</th><th>Кількість</th><th>Дії</th></tr>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= $e($p['sku']) ?></td>
                <td><?= $e($p['name']) ?></td>
                <td><?= number_format((float) $p['price'], 2) ?></td>
                <td><?= (int) $p['quantity'] ?></td>
                <td>
                    <a href="index.php?action=edit&amp;id=<?= (int) $p['id'] ?>">Редагувати</a>
                    <form method="post" action="index.php?action=delete" class="inline"
                          onsubmit="return confirm('Видалити товар?')">
                        <input type="hidden" name="id" value="<?= (int) $p['id'] ?>">
                        <button type="submit" class="danger">Видалити</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$products): ?><tr><td colspan="5">Товарів ще немає.</td></tr><?php endif; ?>
    </table>


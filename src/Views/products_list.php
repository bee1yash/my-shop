<?php $e = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); ?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Облік товарів</title>
    <style>
    :root {
        --bg: #121212;
        --surface: #1e1e1e;
        --border: #333;
        --text: #e6e6e6;
        --muted: #9a9a9a;
        --accent: #4f8cff;
        --error: #ff6b6b;
    }
    body {
        font-family: Arial, sans-serif;
        max-width: 800px;
        margin: 20px auto;
        background: var(--bg);
        color: var(--text);
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 16px;
        background: var(--surface);
    }
    th, td {
        border: 1px solid var(--border);
        padding: 6px 10px;
        text-align: left;
    }
    th { color: var(--muted); }
    .error { color: var(--error); margin: 10px 0; }
    form input {
        margin-right: 6px;
        padding: 6px 8px;
        background: var(--surface);
        color: var(--text);
        border: 1px solid var(--border);
        border-radius: 4px;
    }
    button {
        padding: 6px 12px;
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
</style>
</head>
<body>
    <h1>Облік товарів</h1>

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
        <tr><th>SKU</th><th>Назва</th><th>Ціна</th><th>Кількість</th></tr>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= $e($p['sku']) ?></td>
                <td><?= $e($p['name']) ?></td>
                <td><?= number_format((float) $p['price'], 2) ?></td>
                <td><?= (int) $p['quantity'] ?></td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$products): ?><tr><td colspan="4">Товарів ще немає.</td></tr><?php endif; ?>
    </table>
</body>
</html>
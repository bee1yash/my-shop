<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $e($title ?? 'Облік товарів') ?></title>
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
    a { color: var(--accent); }
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
    form.inline { display: inline; margin-left: 8px; }
    button {
        padding: 6px 12px;
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button.danger { background: #c0392b; }
    </style>
</head>
<body>
    <h1>Облік товарів</h1>

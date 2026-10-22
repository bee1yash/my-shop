<?php
spl_autoload_register(function (string $class): void {
    if (!str_starts_with($class, 'App\\')) {
        return;
    }
    $path = __DIR__ . '/../src/' . str_replace('\\', '/', substr($class, 4)) . '.php';
    if (file_exists($path)) {
        require $path;
    }
});
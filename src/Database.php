<?php
namespace App;

use PDO;

final class Database
{
    private static ?PDO $pdo = null;

    public static function connection(): PDO
    {
        if (self::$pdo === null) {
            $path = dirname(__DIR__) . '/database/store.sqlite';
            $isNew = !file_exists($path);

            $pdo = new PDO('sqlite:' . $path);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            if ($isNew) {
                $pdo->exec(file_get_contents(dirname(__DIR__) . '/database/schema.sql'));
            }
            self::$pdo = $pdo;
        }
        return self::$pdo;
    }
}
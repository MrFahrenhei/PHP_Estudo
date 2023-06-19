<?php

    namespace Alura\Pdo\Infrastructure\Persistence;

    use PDO;

    class ConnectionCreator
    {
        public static function createConnection(): PDO
        {
            $path = __DIR__.'../../../../banco.sqlite';
            $conn = new PDO('sqlite:'.$path);    
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        }
    }
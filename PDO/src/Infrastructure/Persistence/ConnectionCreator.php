<?php

    namespace Alura\Pdo\Infrastructure\Persistence;

    use PDO;

    class ConnectionCreator
    {
        public static function createConnection(): PDO
        {
            $path = __DIR__.'../../../../banco.sqlite';

            try {
               return new PDO('sqlite:'.$path);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
    }
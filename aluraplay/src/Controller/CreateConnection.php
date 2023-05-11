<?php

    namespace Alura\Mvc\Controller;
    use PDO;
    class CreateConnection
    {
        public static function processaRequisicao(): PDO
        {
            $path = __DIR__.'./../../db.sqlite';
            $conn = new PDO('sqlite:'.$path);    
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        }
    }
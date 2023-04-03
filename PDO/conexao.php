<?php

$path = __DIR__.'/banco.sqlite';

try {
   $pdo = new PDO('sqlite:'.$path);
   echo "Deu boa".PHP_EOL;
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

var_dump($pdo->exec('CREATE TABLE students (id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT);'));
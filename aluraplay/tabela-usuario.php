<?php

    $dbPath = __DIR__.'/db.sqlite';
    $pdo = new PDO("sqlite:$dbPath");

    $pdo->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, email TEXT, password TEXT)');


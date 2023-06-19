<?php

$path = __DIR__.'/db.sqlite';
$pdo = new PDO("sqlite:$path");
$pdo->exec('CREATE TABLE videos (id INTEGER PRIMARY KEY, url TEXT, title TEXT);');

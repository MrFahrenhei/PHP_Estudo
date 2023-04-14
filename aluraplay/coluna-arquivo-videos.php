<?php

    $dbPath = __DIR__. '/db.sqlite';
    $pdo = new PDO("sqlite:$dbPath");
    //$pdo->exec('ALTER TABLE videos DROP COLUMN COLUM');
    $pdo->exec('ALTER TABLE videos ADD COLUMN image_path TEXT');
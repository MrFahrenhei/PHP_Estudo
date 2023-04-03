<?php
    require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';
    use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;


    $pdo = ConnectionCreator::createConnection();

    $stmt = $pdo->query('SELECT * FROM students');
    $stmtList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($stmtList);
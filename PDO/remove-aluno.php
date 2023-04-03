<?php
    require_once 'vendor/autoload.php';
    require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';

    use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

    $pdo = ConnectionCreator::createConnection();

    $sqlDelete = 'DELETE FROM students WHERE id = :id';
    $prepareSTMT = $pdo->prepare($sqlDelete);
    $prepareSTMT->bindValue(':id', 1, PDO::PARAM_INT);
    if($prepareSTMT->execute()){
        echo "Deletado";
    }else{
        echo "Deu ruim";
    }
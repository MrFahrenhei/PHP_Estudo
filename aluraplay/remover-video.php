<?php
    $path = __DIR__.'/db.sqlite';
    $pdo = new PDO("sqlite:$path");
    $id = $_GET['id'];
    $sql = 'DELETE FROM videos WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $id);
    
    if($stmt->execute() === false){
        header('Location: /index.php?sucess=0');
    }else{
        header('Location: /index.php?sucess=1');
    }
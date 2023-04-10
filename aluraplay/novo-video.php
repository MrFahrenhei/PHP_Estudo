<?php
    $path = __DIR__.'/db.sqlite';
    $pdo = new PDO("sqlite:$path");

    $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
    if($url == false){
        header('Location: /index.php?sucess=0');
        exit();
    }
    $titulo = filter_input(INPUT_POST, 'title');
    if($titulo == false){
        header('Location ./index.php?sucess=0');
        exit();
    }

    $sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $url);
    $stmt->bindValue(2, $titulo);

    if($stmt->execute() === false){
        header('Location: /index.php?sucess=0');
    }else{
        header('Location: /index.php?sucess=1');
    }
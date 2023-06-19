<?php
    $nome = "Vinícius Valle Beraldo";
    $email = "ViníciusvalleB@alura.com.br";
    $posicaoDaArroba = strpos($email, "@");
    $senha = "123é";
    echo strlen($senha).PHP_EOL;
    $user = substr($email, 0, $posicaoDaArroba);
    echo strtoupper($user).PHP_EOL;
    echo strtolower($user).PHP_EOL;
    echo mb_strtoupper($user).PHP_EOL;
    echo $user.PHP_EOL;
    echo substr($email, $posicaoDaArroba+1).PHP_EOL;
    var_dump(explode(' ', $nome));
    list($nome, $sobrenome) = explode(' ', $nome);
    echo "Nome: $nome".PHP_EOL;echo "Sobrenome: $sobrenome".PHP_EOL;
    echo trim($email).PHP_EOL;
<?php
    $nome = "Vinícius Valle Beraldo";
    $nomeDaFamilia = str_contains($nome, "Jones");
    if($nomeDaFamilia){
        echo "$nome é da minha família".PHP_EOL;
    }else{
        echo "$nome não é da minha família".PHP_EOL;
    }
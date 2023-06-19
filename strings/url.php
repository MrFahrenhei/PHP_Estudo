<?php
    $url = "https://google.com.br";
    if(str_starts_with($url, 'https')){
        echo "É um URL segura";
    }else{
        echo "Não é uma URL segura";
    }
    echo PHP_EOL;
    if(str_ends_with($url, '.br')){
        echo "É um domínio do Brasil";
    }else{
        echo "Não é um domínio do Brasil";
    }
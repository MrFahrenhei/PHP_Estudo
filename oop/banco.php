<?php
    require_once 'src/Conta.php';

    $primeiraConta = new Conta();
    $primeiraConta->depositar(500);
    echo $primeiraConta->getSaldo().PHP_EOL;
    $primeiraConta->sacar(300);
    echo $primeiraConta->getSaldo().PHP_EOL;
    $primeiraConta->setCPF('123.456.789-50');
    echo $primeiraConta->getCPF();
?>
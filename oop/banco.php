<?php
    require_once 'src/Conta.php';

    $primeiraConta = new Conta('11465020950','vinicius');
    $primeiraConta->depositar(500);
    echo $primeiraConta->getSaldo().PHP_EOL;
    $primeiraConta->sacar(300);
    echo $primeiraConta->getSaldo().PHP_EOL;
    echo $primeiraConta->getCPF().PHP_EOL;
    echo $primeiraConta->getNome().PHP_EOL;
?>
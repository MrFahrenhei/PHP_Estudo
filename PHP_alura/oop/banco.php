<?php
require_once 'src/Conta.php';
require_once 'src/Titular.php';

$conta1 = new Conta(new Titular("114.650.209-50", "Vinícius Valle Beraldo"));
$conta1->setDepostiar(100);
$conta1->setSacar(50);

echo 'ID:'.$conta1->getID().' Nome: '.$conta1->getNameTitular().' Cpf: '.$conta1->getCPFTitular().' Saldo: R$'.$conta1->getSaldo().PHP_EOL;

$conta2 = new Conta(new Titular("3423423", "John"));

echo 'ID:'.$conta2->getID().' Nome: '.$conta2->getNameTitular().' Cpf: '.$conta2->getCPFTitular().' Saldo: R$'.$conta2->getSaldo().PHP_EOL;

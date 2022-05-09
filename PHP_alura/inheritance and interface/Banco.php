<?php

require_once 'src/Conta.php';
require_once 'src/Endereco.php';
require_once 'src/Titular.php';
require_once 'src/CPF.php';


$endereco = new Endereco("Cascacity", "novo não lembro", "Rua talz", "1234");
$vinicius = new Titular(new CPF('123.456.789-10'), 'Vinicius Valle', $endereco);
$primeiraConta = new Conta($vinicius);
$primeiraConta->depositar(500);
$primeiraConta->sacar(300); // isso é ok

echo $primeiraConta->getNomeTitular() . PHP_EOL;
echo $primeiraConta->getCpfTitular() . PHP_EOL;
echo $primeiraConta->getSaldo() . PHP_EOL;

$viks = new Titular(new CPF('698.549.548-10'), 'Viks', $endereco);
$segundaConta = new Conta($viks);
var_dump($segundaConta);

$outra = new Conta(new Titular(new CPF('123.654.789-01'), 'Abcdefg', $endereco));
unset($segundaConta);
echo Conta::getNumeroDeContas();

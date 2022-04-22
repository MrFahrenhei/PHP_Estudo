<?php

$conta1 = [
    'titular' => 'Vinícus',
    'saldo' => 1000
];
$conta2 = [
    'titular' => 'Maria',
    'saldo' => 1700
];
$conta3 = [
    'titular' => 'José',
    'saldo' => 1200
];
$todasContas = [$conta1, $conta2, $conta3];
$cpfContas = [
  11465020950 => $conta1,
  34540349390 => $conta2,
  47654329340 => $conta3
];
foreach ($todasContas as $conta){
    echo $conta['titular'].PHP_EOL;
}
foreach ($cpfContas as $cpf => $conta){
    echo $cpf. PHP_EOL;
}
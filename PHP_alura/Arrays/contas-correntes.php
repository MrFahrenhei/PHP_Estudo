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
$todasContas = [$conta1,$conta2, $conta3];

for($i = 0; $i < count($todasContas); $i++){
    echo $todasContas[$i]['titular'].PHP_EOL;
}
<?php

$notas1 = [
    'ana' => '10',
    'joao' => 7,
    'maria' => 4,
    'aarã' => 3,
    'pedro' => null,
    'roberto' => 8,
    'vinicius' => 9,
    'issac' => 1,
];

$notas2 = [
    10,
    23,
    2,
    1,
    3.14,
    99,
];
// in_array verifica se o valor existe
var_dump(is_array($notas1));
// array_is_list verifica se a array dada é uma lista
var_dump(array_is_list($notas2));
// array_key_exists verifica se a chave existe
var_dump(array_key_exists('issac',$notas1));
// isset verifica se a chave existe e não é nula
var_dump(isset($notas1['pedro']));
// utiliza o ==
var_dump(in_array(10, $notas1));
// utilizar o ===
var_dump(in_array(10, $notas1, true));
// procura quem é o dono do valor;
var_dump(array_search(10, $notas1));
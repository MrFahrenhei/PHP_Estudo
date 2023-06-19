<?php

$notas1 = [
    'ana',
    'joao',
    'maria',
    'aarã',
    
];
$notas2 = [
    'pedro',
    'roberto',
    'vinicius',
    'issac',
];

$newNames = [...$notas1,'Braian',...$notas2];
array_push($newNames, 'Alice', 'bob', 'fred');
//outra forma de add nome, mas no final
$newNames[] = 'abreu';

//add no início do array
array_unshift($newNames, 'stephane', 'beatriz');
// remove o priemiro elemento do array
echo array_shift($newNames). PHP_EOL;
// remove o último elelemtno do array
echo array_pop($newNames). PHP_EOL;

var_dump($newNames);

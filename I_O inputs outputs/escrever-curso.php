<?php
//Maneira 1 de criar um arquivo com texto.
//$arquivo = fopen('cursos-php.txt', 'a');
//$curso = 'Design Patterns PHP II: Boas práticas de programação'.PHP_EOL;
//fwrite($arquivo, $curso);
//fclose($arquivo);

$curso = 'Design Patterns PHP I: Boas práticas de programação'.PHP_EOL;
//Para sobrescrever tudo
//file_put_contents('cursos-php.txt', $curso);
//Para concatenar
file_put_contents('cursos-php.txt', $curso, FILE_APPEND);
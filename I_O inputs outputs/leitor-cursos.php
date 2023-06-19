<?php

//$arquivo = fopen('lista-cursos.txt', 'r');

//Maneira 1 de ler arquivo
//while(!feof($arquivo)){
//    $curso = fgets($arquivo);
//    echo $curso.PHP_EOL;
//}
//fclose($arquivo);

//Maneira 2 de ler arquivo
//$tamanhoDoArquivo = filesize('lista-cursos.txt');
//$curso = fread($arquivo, $tamanhoDoArquivo);
//echo $curso;
//fclose($arquivo);

//Maneira 3 de ler arquivo
$cursos = file_get_contents('lista-cursos.txt');
echo $cursos;
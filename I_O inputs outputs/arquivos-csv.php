<?php

$meusCursos = file('lista-cursos.txt');
$outroCursos = file('cursos-php.txt');

$arquivoCsv = fopen('cursos.csv', 'w');

foreach ($meusCursos as $curso){
    $linha = [trim(mb_convert_encoding($curso, 'Windows-1252', 'UTF-8')), 'Sim'];
    fputcsv($arquivoCsv, $linha, ';');
    //fwrite($arquivoCsv, implode(',', $linha));
}
foreach ($outroCursos as $curso){
    $linha = [trim(utf8_decode($curso)), 'Não'];
    fputcsv($arquivoCsv, $linha, ';');
    //fwrite($arquivoCsv, implode(',', '$linha'));
}

fclose($arquivoCsv);
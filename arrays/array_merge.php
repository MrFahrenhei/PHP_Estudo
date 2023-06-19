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
    //array_merge não preserva as chaves
    $alunosNovos = array_merge($notas1, $notas2);
    var_dump($alunosNovos);
    // outra maneira de fazer o merge é utilizando o operador +


    $unpack = [...$notas1, 'braian' ,...$notas2];
    var_dump($unpack);


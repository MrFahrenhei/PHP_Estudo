<?php 
    $notas = [
        'ana' => 10,
        'joao' => 7,
        'maria' => 4,
        'aarã' => 3,
        'roberto' => 8,
        'vinicius' => 9,
        'issac' => 1,
    ];
    $arChaves = $notas;
    $arValues = $notas;
    $arKey = $notas;
    // mantem as chaves ao ordernar
    arsort($arChaves);
    // só ordena os valores
    rsort($arValues);
    // ordernar utilizando as chaves (da para fazer descrescente com krsort() E tem o uksort() que faz o mesmo que o usort() )
    ksort($arKey);

    echo ("Notas normais:".PHP_EOL);
    var_dump($notas);

    echo ("Ordenar notas com chaves:".PHP_EOL);
    var_dump($arChaves);

    echo ("Ordernar notas só os valores".PHP_EOL);
    var_dump($arValues);

    echo ("Ordena utilizando só as chaves".PHP_EOL);
    var_dump($arKey);
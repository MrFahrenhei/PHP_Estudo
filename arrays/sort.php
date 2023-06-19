<?php

    $notas = [
        10,
        23,
        2,
        1,
        3.14,
        99,
    ];

    $notaBKP = $notas;
    sort($notaBKP);
    echo "Desordenado\n";
    var_dump($notas);
    echo "Ordenados\n";
    var_dump($notaBKP);
<?php
    $notas = [
        [
            'aluno' => 'Maria',
            'nota' => 10,
        ],
        [
            'aluno' => 'Vinícus',
            'nota' => 6,
        ],
        [
            'aluno' => 'José',
            'nota' => 9,
        ],
        [
            'aluno' => 'Matheus',
            'nota' => 3,
        ],
        [
            'aluno' => 'Marco',
            'nota' => 10,
        ]
    ];

    usort($notas, function($nota1, $nota2){
        $nota1st = $nota1['nota'];
        $nota2nd = $nota2['nota'];
        // if($nota1st > $nota2nd){ return -1; }
        // if($nota2nd > $nota1st){ return 1; }
        //return 0;
        return $nota2nd <=> $nota1st;
    });
    var_dump($notas);
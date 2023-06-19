<?php
    $notas1 = [
        'ana' => 10,
        'joao' => 7,
        'maria' => 4,
        'aarã' => 3,
        'pedro' => 6,
        'roberto' => 8,
        'vinicius' => 9,
        'issac' => 1,
    ];
    //deletei os pedro
    $notas2 = [
        'ana' => 10,
        'joao' => 7,
        'maria' => 4,
        'aarã' => 3,
        'roberto' => 8,
        'vinicius' => 9,
        'issac' => 6,
    ];
    // leva em consideração os valores de uma array comparando com outra 
    echo "considera só os valores".PHP_EOL;
    var_dump(array_diff($notas1, $notas2));
    // leva só as keys e ignora os valores
    echo "considera só as chaves".PHP_EOL;
    var_dump(array_diff_key($notas1, $notas2));
    // compara tanto a chave quanto o valor
    echo "considera chave e valor".PHP_EOL;
    var_dump(array_diff_assoc($notas1, $notas2));
    echo "---------------------------------".PHP_EOL;
    $alunosFaltantes = array_diff_key($notas1, $notas2);
    $nomesAluno = array_keys($alunosFaltantes);
    $notasAluno = array_values($alunosFaltantes);

    var_dump(array_combine($notasAluno,$nomesAluno));
<?php

    $telefones = ['(24) 99999 - 9999', '(21) 99999 - 9999', '(24) 2222 - 2222'];
    echo implode(PHP_EOL, $telefones).PHP_EOL;
    echo implode(', ', $telefones).PHP_EOL;
    //echo implode(array: $telefones, separator: ', ').PHP_EOL;
    var_dump($telefones);
<?php
function funcao3(){
    echo 'Entrei na função 3'.PHP_EOL;
    try {
        funcao4();
    }catch (RuntimeException $e){
        echo "Na função 3, eu resolvi problema da função 4".PHP_EOL;
    }
    echo 'Saindo da função 3'.PHP_EOL;
}
function funcao4(){
    echo 'Entrei na função 4'.PHP_EOL;
    $arrayFixo = new SplFixedArray(2);
    $arrayFixo[3] = 'Valor';
    //$divisao = intdiv(5, 0);
    for($i = 1; $i <= 5; $i++){
        echo $i.PHP_EOL;
    }
    echo "Saindo da função 4".PHP_EOL;
}

echo 'Iniciando o programa principal'.PHP_EOL;
funcao3();
echo 'Iniciando o programa principal'.PHP_EOL;
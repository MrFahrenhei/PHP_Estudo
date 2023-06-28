<?php
function funcao5(){
    echo 'Entrei na função 5'.PHP_EOL;
    try {
        funcao6();
    }catch (RuntimeException | DivisionByZeroError $e){
        echo "Na função 5, eu resolvi problema da função 6".PHP_EOL;
        echo "Mensage: ".$e->getMessage().PHP_EOL;
        echo "Linha: ".$e->getLine().PHP_EOL;
        echo "Traço: ".$e->getTraceAsString().PHP_EOL;
    }
    /*catch (DivisionByZeroError $error){
        echo "Erro ao dividir número por zero".PHP_EOL;
    }*/
    echo 'Saindo da função 5'.PHP_EOL;
}
function funcao6(){
    echo 'Entrei na função 6'.PHP_EOL;
    $divisao = intdiv(5, 0);
    $arrayFixo = new SplFixedArray(2);
    $arrayFixo[3] = 'Valor';
    for($i = 1; $i <= 5; $i++){
        echo $i.PHP_EOL;
    }
    echo "Saindo da função 6".PHP_EOL;
}

echo 'Iniciando o programa principal'.PHP_EOL;
funcao5();
echo 'Iniciando o programa principal'.PHP_EOL;
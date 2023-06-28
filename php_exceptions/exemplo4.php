<?php
function funcao7(){
    echo 'Entrei na função 7'.PHP_EOL;
    try {
        funcao8();
    }catch (RuntimeException | DivisionByZeroError $e){
        echo "Na função 7, eu resolvi problema da função 6".PHP_EOL;
        echo "Mensage: ".$e->getMessage().PHP_EOL;
        echo "Linha: ".$e->getLine().PHP_EOL;
        echo "Traço: ".$e->getTraceAsString().PHP_EOL;
        throw new RuntimeException(
            'Exceção foi tratada, mas pera ai',
            1,
            $e);
    }
    /*catch (DivisionByZeroError $error){
        echo "Erro ao dividir número por zero".PHP_EOL;
    }*/
    echo 'Saindo da função 7'.PHP_EOL;
}
function funcao8(){
    echo 'Entrei na função 8'.PHP_EOL;
    $exception = new RuntimeException();
    throw $exception;
    echo "Saindo da função 8".PHP_EOL;
}

echo 'Iniciando o programa principal'.PHP_EOL;
funcao7();
echo 'Iniciando o programa principal'.PHP_EOL;
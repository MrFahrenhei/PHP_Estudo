<?php
function funcao9(){
    echo 'Entrei na função 9'.PHP_EOL;
    try {
        funcao10();
    }catch (Throwable $e){
        echo "Exception here".PHP_EOL;
        echo "Mensage: ".$e->getMessage().PHP_EOL;
        echo "Linha: ".$e->getLine().PHP_EOL;
        echo "Traço: ".$e->getTraceAsString().PHP_EOL;
    }
//    catch (Error $error){
//        echo "Exception here".PHP_EOL;
//        echo "Mensage: ".$error->getMessage().PHP_EOL;
//        echo "Linha: ".$error->getLine().PHP_EOL;
//        echo "Traço: ".$error->getTraceAsString().PHP_EOL;
//    }
    echo 'Saindo da função 9'.PHP_EOL;
}
function funcao10(){
    echo 'Entrei na função 10'.PHP_EOL;
    intdiv(1, 0);
    throw new BadFunctionCallException('Exceção aqui');
    echo "Saindo da função 10".PHP_EOL;
}

echo 'Iniciando o programa principal'.PHP_EOL;
funcao9();
echo 'Iniciando o programa principal'.PHP_EOL;
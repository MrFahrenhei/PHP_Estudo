<?php
echo "Números pares";
for($index = 1; $index <= 100; $index++){
    if(($index % 2) == 0){
        echo "Número par: $index".PHP_EOL;
    }
}

echo "Números impares";
for($index = 1; $index <= 100; $index++){
    if(($index % 2) != 0){
        echo "Número impar: $index".PHP_EOL;
    }
}
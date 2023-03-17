<?php

echo "Olá mundo!".PHP_EOL;

function CapslockGeneric(string $str){
    return mb_strtoupper($str).PHP_EOL;
}
echo CapslockGeneric('vinicius');

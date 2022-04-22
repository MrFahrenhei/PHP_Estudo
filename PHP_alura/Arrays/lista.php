<?php
$idadeList = [12, 23, 34, 45, 56, 18, 21];

list($idadeVinicius, $idadeJoao, $idadeMaria) = $idadeList;

//$idadeVinicius = $idadeList[0];
//$idadeJoao = $idadeList[1];
//$idadeMaria = $idadeList[2];

$idadeList[] = 20;

foreach($idadeList as $idade){
    echo $idade. PHP_EOL;
}
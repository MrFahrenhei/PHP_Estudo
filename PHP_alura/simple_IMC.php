<?php
$peso = 85;
$altura = 1.75;
$imc = $peso / ($altura ** 2);
echo "Seu imc é $imc, você está ".(($imc < 18? "baixo" : ($imc < 25? "dentro" : "acima") ))."do recomendado";
<?php
$tela = fopen('php://stdout', 'w');
fwrite($tela, 'Olá Mundo');

fwrite(STDOUT, 'Olá Mundo STDOUT');
fwrite(STDERR, 'Olá Mundo STDERR');
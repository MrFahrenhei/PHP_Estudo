<?php
require 'MeuFiltro.php';
$arquivoCursos = fopen('lista-cursos.txt', 'r');

stream_filter_register('beraldo.partes', MeuFiltro::class);
stream_filter_append($arquivoCursos, 'beraldo.partes');

echo fread($arquivoCursos, filesize('lista-cursos.txt'));
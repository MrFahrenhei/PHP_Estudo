<?php 
    $dados = [
        'nome' => 'Vinícius', 
        'nota' => 10, 
        'idade' => 25];
    //list( $nome, $nota, $idade) = $dados;
    //[$nome, $nota, $idade] = $dados;

    //para pegar os dados apenas e cria variáveis
    extract($dados);

    var_dump($nome, $nota, $idade);

    // pega as variáveis e compacta num array
    var_dump(compact('nome', 'nota', 'idade'));

    
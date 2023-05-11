<?php

namespace Alura\Leilao\Model;

class Usuario
{

    // public readonly string $nome;

    // public function __construct(string $nome)
    // {
    //     $this->nome = $nome;
    // }

    // public function getNome(): string
    // {
    //     return $this->nome;
    // }
    

    public function __construct(
        public readonly string $nome
    )
    {}
}

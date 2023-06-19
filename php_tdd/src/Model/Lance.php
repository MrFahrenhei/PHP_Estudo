<?php

namespace Alura\Leilao\Model;

class Lance
{
    // public readonly Usuario $usuario;
    // public readonly float $valor;

    // public function __construct(Usuario $usuario, float $valor)
    // {
    //     $this->usuario = $usuario;
    //     $this->valor = $valor;
    // }

    // public function getUsuario(): Usuario
    // {
    //     return $this->usuario;
    // }

    // public function getValor(): float
    // {
    //     return $this->valor;
    // }
    

    public function __construct(
        public readonly Usuario $usuario,
        public readonly float $valor
    )
    {
    }
}

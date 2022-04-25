<?php

class Conta
{
    private static $idUser = 0;
    private $titular;
    private $saldo;

    public function __construct(Titular $titular){
        $this->titular = $titular;
        $this->saldo = 0;
        self::$idUser++;
    }

    public static function getID(): int{
        return self::$idUser;
    }

    public function setSacar(float $valorSacar){
        if($valorSacar > $this->saldo){
            echo "Saldo indisponível";
            return;
        }
            $this->saldo -= $valorSacar;
    }

    public function setDepostiar(float $valorDepositar):void{
        if($valorDepositar < 0){
            echo "Valor precisa ser positivo";
            return;
        }
            $this->saldo += $valorDepositar;
    }

    public function setTransferir(float $valorTransferir, Conta $contaDestino): void{
        if($valorTransferir -> $this->saldo){
            echo "saldo indisponível";
            return;
        }
            $this->sacar($valorTransferir);
            $contaDestino->depostiar($valorTransferir);
    }
    public function getSaldo(): float{
        return $this->saldo;
    }
    public function getNameTitular(): string{
        return $this->titular->getNome();
    }
    public function getCPFTitular(): string{
        return $this->titular->getCpf();
    }
}
<?php
    
    class Conta 
    {
        private $cpfTitular;
        private $nomeTitular;
        private $saldo = 0;
        private static $id = 0;

        public function __construct(string $cpfTitular, string $nomeTitular)
        {
            $this->cpfTitular = $cpfTitular;
            $this->nomeTitular = $nomeTitular;
            $this->saldo = 0;

            self::$id++;
        }

        public function sacar(float $valorSacar): void{
            if($valorSacar > $this->saldo){
                echo "Saldo indisponível";
                return;
            }
            $this->saldo -= $valorSacar;
        }

        public function depositar(float $valorDepositar): void{
            if($valorDepositar < 0){
                echo "Valor precisa ser positivo";
                return;
            }

            $this->saldo += $valorDepositar;
        }

        public function transferir(float $valorTransferir, Conta $contaDestino): void{
            if($valorTransferir > $this->saldo){
                echo "Saldo indisponível";
                return;
            }
            $this->sacar($valorTransferir);
            $contaDestino->depositar($valorTransferir);
        }
        
        public function setCPF(string $cpf): void{
            $this->cpfTitular = $cpf;
        }

        public function setName(string $name): void{
            $this->nomeTitular = $name;
        }

        public function getSaldo(): float{
            return $this->saldo;
        }

        public function getCPF(): string{
            return $this->cpfTitular;
        }

        public function getNome(): string{
            return $this->nomeTitular;
        }
        
    }



?>
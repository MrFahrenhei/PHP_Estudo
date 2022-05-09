<?php

class Titular
{
    private CPF $cpf;
    private string $nome;
    private Endereco $adress;


    public function __construct(CPF $cpf, string $nome, Endereco $adress)
    {
        $this->cpf = $cpf;
        $this->validaNomeTitular($nome);
        $this->nome = $nome;
        $this->adress = $adress;
    }

    public function getCPF(): string
    {
        return $this->cpf->getNumero();
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    private function validaNomeTitular(string $nomeTitular)
    {
        if (strlen($nomeTitular) < 5) {
            echo "Nome precisa ter pelo menos 5 caracteres";
            exit();
        }
    }

    private function getAdress(): Endereco{
        return $this->adress;
    }
}
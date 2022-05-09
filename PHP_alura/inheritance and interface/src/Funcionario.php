<?php

class Funcionario extends Titular
{
    private string $nome;
    private CPF $cpf;
    private string $cargo;

    public function __construct(string $nome, CPF $cpf, string $cargo)
    {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->cargo = $cargo;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
    public function getCpf(): CPF
    {
        return $this->cpf;
    }
    public function getCargo(): string
    {
        return $this->cargo;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }
    public function setCpf(CPF $cpf): void
    {
        $this->cpf = $cpf;
    }
    public function setCargo(string $cargo): void
    {
        $this->cargo = $cargo;
    }
}
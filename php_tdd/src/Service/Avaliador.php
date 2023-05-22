<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private float $menorValor = INF;
    private float $maiorValor = -INF;
    private array $maioresLances;

    public function __construct(
    ){
        $maiorValor = $this->maiorValor;
        $menorValor = $this->menorValor;
        $maioresLances = $this->maioresLances;
    }

    public function avalia(Leilao $leilao): void
    {
        foreach($leilao->getLances() as $lance){
            if($lance->valor > $this->maiorValor){
                $this->maiorValor = $lance->valor;
            }
            if($lance->valor < $this->menorValor){
                $this->menorValor = $lance->valor;
            }
        }
        $lances = $leilao->getLances();
        usort($lances, function (Lance $lance1, Lance $lance2){
            return $lance1->valor - $lance2->valor;
        });
        $this->maioresLances = array_slice($lances, 0, 3);
    }
    public function getMaiorValor(): float
    {
        return $this->maiorValor;
    }

    public function getMenorValor(): float
    {
        return $this->menorValor;
    }

    public function getMaioresLances(): array
    {
        return $this->maioresLances;
    }
}
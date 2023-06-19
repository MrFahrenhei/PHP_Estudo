<?php

namespace Alura\Leilao\Model;

class Leilao
{
    /** @var Lance[] */
    private $lances;
    private bool $finalizado;

    public readonly string $descricao;

    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
        $this->finalizado = false;
    }

    public function recebeLance(Lance $lance)
    {
        if(!empty($this->lances) && $this->lastUser($lance)){
            throw new \DomainException('Usuário não pode propor 2 lances consecutivos');
        }
        $usuario = $lance->usuario;
        $totalLancesUsuario = $this->quantidadeLancesPorUsuario($usuario);
        if($totalLancesUsuario >= 5){
            throw new \DomainException('Usuário não pode propor mais de 5 lances por leilão');
        }
        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }
    public function finaliza()
    {
        $this->finalizado = true;
    }
    public function estaFinalizado(): bool
    {
        return $this->finalizado;
    }
    /**
     * @param Lance $lance
     * @return bool
     */
    private function lastUser(Lance $lance): bool
    {
        $ultimoLance = $this->lances[count($this->lances) - 1];
        return $lance->usuario == $ultimoLance->usuario;
    }

    /**
     * @param Usuario $usuario
     * @return int
     */
    private function quantidadeLancesPorUsuario(Usuario $usuario): int
    {
        return array_reduce(
            $this->lances, function (int $totalAcumulado, Lance $lanceAtual) use ($usuario) {
            if ($lanceAtual->usuario == $usuario) {
                return $totalAcumulado + 1;
            }
            return $totalAcumulado;
        }, 0
        );
    }


}

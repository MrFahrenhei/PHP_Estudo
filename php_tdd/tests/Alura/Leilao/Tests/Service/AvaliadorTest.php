<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    /**
     * @dataProvider LeilaoOrdemAleatoria
     * @dataProvider LeilaoOrdemCrescente
     * @dataProvider LeilaoOrdemDecrescente
     */
    public function testEncontrarMaiorValor(Leilao $leilao)
    {
        // Arrange - Given
        $leiloeiro = new Avaliador();
        // Act - When
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();
        // Assert - Then

        self::assertEquals(2500, $maiorValor);
    }
    /**
     * @dataProvider LeilaoOrdemAleatoria
     * @dataProvider LeilaoOrdemCrescente
     * @dataProvider LeilaoOrdemDecrescente
     */
    public function testEncontrarMenorValor(Leilao $leilao)
    {
        // Arrange - Given
        $leiloeiro = new Avaliador();
        // Act - When
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();
        // Assert - Then

        self::assertEquals(1700, $menorValor);
    }
    /**
     * @dataProvider LeilaoOrdemAleatoria
     * @dataProvider LeilaoOrdemCrescente
     * @dataProvider LeilaoOrdemDecrescente
     */
    public function testEncontrarMenorValorDecrescente(Leilao $leilao)
    {
        // Arrange - Given
        $leiloeiro = new Avaliador();
        // Act - When
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();
        // Assert - Then

        self::assertEquals(1700, $menorValor);
    }
    /**
     * @dataProvider LeilaoOrdemAleatoria
     * @dataProvider LeilaoOrdemCrescente
     * @dataProvider LeilaoOrdemDecrescente
     */
    public function testEncontrar3MaiorValor(Leilao $leilao)
    {
        // Arrange - Given
        $leiloeiro = new Avaliador();
        // Act - When
        $leiloeiro->avalia($leilao);
        $maiores = $leiloeiro->getMaioresLances();
        // Assert - Then
        static::assertCount(3, $maiores);
        static::assertEquals(1700, $maiores[0]->valor);
        static::assertEquals(2000, $maiores[1]->valor);
        static::assertEquals(2500, $maiores[2]->valor);
    }

    public static function LeilaoOrdemCrescente()
    {
        $leilao = new Leilao("Fiat 147 0KM");

        $maria = new Usuario('Maria');
        $joao = new Usuario("João");
        $ana = new Usuario("Ana");

        $leilao->recebeLance(new Lance($ana, 1700));
        $leilao->recebeLance(new Lance($maria, 2000));
        $leilao->recebeLance(new Lance($joao, 2500));

        return [
            [$leilao]
        ];
    }

    public static function LeilaoOrdemDecrescente()
    {
        $leilao = new Leilao("Fiat 147 0KM");

        $maria = new Usuario('Maria');
        $joao = new Usuario("João");
        $ana = new Usuario("Ana");

        $leilao->recebeLance(new Lance($joao, 2500));
        $leilao->recebeLance(new Lance($maria, 2000));
        $leilao->recebeLance(new Lance($ana, 1700));

        return [
            [$leilao]
        ];
    }

    public static function LeilaoOrdemAleatoria()
    {
        $leilao = new Leilao("Fiat 147 0KM");

        $maria = new Usuario('Maria');
        $joao = new Usuario("João");
        $ana = new Usuario("Ana");

        $leilao->recebeLance(new Lance($maria, 2000));
        $leilao->recebeLance(new Lance($joao, 2500));
        $leilao->recebeLance(new Lance($ana, 1700));

        return [
            [$leilao]
        ];
    }

}
<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testEncontrarOMaiorValorCrescente()
    {
        // Arrange - Given
        $leilao = new Leilao("Fiat 147 0KM");
        $maria = new Usuario('Maria');
        $joao = new Usuario("João");

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leiloeiro = new Avaliador();
        // Act - When
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();
        // Assert - Then

        self::assertEquals(2500, $maiorValor);
    }
    public function testEncontrarOMaiorValorDecrescente()
    {
        // Arrange - Given
        $leilao = new Leilao("Fiat 147 0KM");
        $maria = new Usuario('Maria');
        $joao = new Usuario("João");

        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leiloeiro = new Avaliador();
        // Act - When
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();
        // Assert - Then

        self::assertEquals(2500, $maiorValor);
    }
    public function testEncontrarMenorValorCrescente()
    {
        // Arrange - Given
        $leilao = new Leilao("Fiat 147 0KM");
        $maria = new Usuario('Maria');
        $joao = new Usuario("João");

        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leiloeiro = new Avaliador();
        // Act - When
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();
        // Assert - Then

        self::assertEquals(2000, $menorValor);
    }
    public function testEncontrarMenorValorDecrescente()
    {
        // Arrange - Given
        $leilao = new Leilao("Fiat 147 0KM");
        $maria = new Usuario('Maria');
        $joao = new Usuario("João");

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leiloeiro = new Avaliador();
        // Act - When
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();
        // Assert - Then

        self::assertEquals(2000, $menorValor);
    }
    public function testEncontrarMaiorValor()
    {
        // Arrange - Given
        $leilao = new Leilao("Fiat 147 0KM");
        $maria = new Usuario('Maria');
        $joao = new Usuario("João");
        $ana = new Usuario("Ana");
        $jorge = new Usuario("Jorge");

        $leilao->recebeLance(new Lance($ana, 1500));
        $leilao->recebeLance(new Lance($maria, 1000));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($jorge, 1700));
        $leiloeiro = new Avaliador();
        // Act - When
        $leiloeiro->avalia($leilao);
        $maiores = $leiloeiro->getMaioresLances();
        // Assert - Then
        static::assertCount(3, $maiores);
        static::assertEquals(1000, $maiores[0]->valor);
        static::assertEquals(1500, $maiores[1]->valor);
        static::assertEquals(1700, $maiores[2]->valor);
    }

}
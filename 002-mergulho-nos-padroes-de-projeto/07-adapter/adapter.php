<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php adapter.php

use JetBrains\PhpStorm\Pure;

class PinoRedondo
{
    public function __construct(
        public int $raio
    ) {}

    public function getRaio(): float
    {
        return $this->raio;
    }
}

class PinoQuadrado
{
    public function __construct(
        public int $largura
    ) {}

    public function getLargura(): int
    {
        return $this->largura;
    }
}

class BuracoRedondo
{
    public function __construct(
        public int $raio
    ) {}

    public function getRaio(): int
    {
        return $this->raio;
    }

    #[Pure] public function cabe(PinoRedondo $pinoRedondo)
    {
        return $this->getRaio() >= $pinoRedondo->getRaio();
    }
}

class AdaptadorDePinoQuadradoParaRedondo extends PinoRedondo
{
    public function __construct(
        public PinoQuadrado $pinoQuadrado
    ) {
        parent::__construct(0);
    }

    #[Pure] public function getRaio(): float
    {
        return ((float) $this->pinoQuadrado->getLargura() * sqrt(2.0)) / 2.00;
    }
}

$buraco10 = new BuracoRedondo(10);
$pinoRedondo10 = new PinoRedondo(10);
$pinoRedondo15 = new PinoRedondo(15);

echo "Pino redondo de {$pinoRedondo10->getRaio()} cabe no buraco de {$buraco10->getRaio()}? {$buraco10->cabe($pinoRedondo10)}" . PHP_EOL;
echo "Pino redondo de {$pinoRedondo15->getRaio()} cabe no buraco de {$buraco10->getRaio()}? {$buraco10->cabe($pinoRedondo15)}" . PHP_EOL;

$pinoQuadrado10 = new PinoQuadrado(100);
$adaptadorDePinoQuadradoParaRedondo = new AdaptadorDePinoQuadradoParaRedondo($pinoQuadrado10);
echo "Pino quadrado de {$pinoQuadrado10->getLargura()} de largura adaptado, cabe no buraco de {$buraco10->getRaio()}? {$buraco10->cabe($adaptadorDePinoQuadradoParaRedondo)}" . PHP_EOL;

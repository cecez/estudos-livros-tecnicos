<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php prototype.php

use JetBrains\PhpStorm\Pure;

interface Prototype
{
    public function clone(): Prototype;
}

enum TipoDeRobo
{
    case ROBOZINHO;
    case ROBOZAO;
}

class Robo implements Prototype
{
    private TipoDeRobo $tipoDeRobo;
    public string $nome;

    #[Pure] public function __construct(Prototype $robo = null)
    {
        if (!is_null($robo)) {
            $this->tipoDeRobo = $robo->getTipoDeRobo();
            $this->nome = $robo->nome;
        }
    }

    #[Pure] public function clone(): Prototype
    {
        return new Robo($this);
    }

    public function getTipoDeRobo(): TipoDeRobo
    {
        return $this->tipoDeRobo;
    }

    public function setTipoDeRobo(TipoDeRobo $tipo)
    {
        $this->tipoDeRobo = $tipo;
    }
}

// Aplicação
$robozinho = new Robo();
$robozinho->setTipoDeRobo(TipoDeRobo::ROBOZINHO);
$robozinho->nome = 'Nominho 1';

$clonezinho = $robozinho->clone();
$clonezinho->nome = 'Cloninho 1';

var_dump($robozinho);
var_dump($clonezinho);


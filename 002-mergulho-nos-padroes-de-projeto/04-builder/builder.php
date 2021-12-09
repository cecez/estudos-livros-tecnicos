<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php builder.php

enum TipoDeMotor
{
    case V8;
    case DOIS_PONTO_ZERO;
    case BARULHENTO;
}

class Carro {
    public int $quantidadeDeAssentos;
    public TipoDeMotor $tipoDeMotor;
    public bool $temDirecaoHidraulica;
}
class ManualDoCarro {}

interface Builder
{
    public function reset();
    public function configuraAssentos(int $quantidade);
    public function configuraMotor(TipoDeMotor $motor);
    public function configuraDirecaoHidraulica(bool $temDirecaoHidraulica);
}

class BuilderDeCarro implements Builder
{
    private Carro $carro;

    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->carro = new Carro();
    }

    public function configuraAssentos(int $quantidade)
    {
        $this->carro->quantidadeDeAssentos = $quantidade;
    }

    public function configuraMotor(TipoDeMotor $motor)
    {
        $this->carro->tipoDeMotor = $motor;
    }

    public function configuraDirecaoHidraulica(bool $temDirecaoHidraulica)
    {
        $this->carro->temDirecaoHidraulica = $temDirecaoHidraulica;
    }

    public function obtemCarro(): Carro
    {
        $produto = $this->carro;
        $this->reset();
        return $produto;
    }
}

// classe BuilderDeManual idêntica a BuilderDeCarro, mas para o manual

class Diretor
{
    public function produzUnoMilho(Builder $builder)
    {
        $builder->reset();
        $builder->configuraAssentos(4);
        $builder->configuraMotor(TipoDeMotor::BARULHENTO);
        $builder->configuraDirecaoHidraulica(false);
    }

    public function produzViper(Builder $builder)
    {
        $builder->reset();
        $builder->configuraAssentos(2);
        $builder->configuraMotor(TipoDeMotor::V8);
        $builder->configuraDirecaoHidraulica(false);
    }
}

// Aplicação
$diretor = new Diretor();
$builderDeCarro = new BuilderDeCarro();
$diretor->produzUnoMilho($builderDeCarro);
$unoMilho = $builderDeCarro->obtemCarro();
var_dump($unoMilho);


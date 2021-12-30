<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php bridge.php

interface Dispositivo
{
    public function isHabilitado();
    public function habilita();
    public function desabilita();
    public function getVolume();
    public function setVolume($percentual);
    public function getCanal();
    public function setCanal($percentual);
}

class ControleRemoto
{
    public function __construct(
        protected Dispositivo $dispositivo
    ) {}

    public function toggleLigar()
    {
        if ($this->dispositivo->isHabilitado()) {
            echo "- Desligando dispositivo." . PHP_EOL;
            $this->dispositivo->desabilita();
        } else {
            echo "- Ligando dispositivo." . PHP_EOL;
            $this->dispositivo->habilita();
        }
    }

    public function aumentarVolume()
    {
        $this->dispositivo->setVolume(
            $this->dispositivo->getVolume() + 10
        );

        echo "- Aumentando volume do dispositivo para {$this->dispositivo->getVolume()}." . PHP_EOL;
    }

    public function diminuirVolume()
    {
        $this->dispositivo->setVolume(
            $this->dispositivo->getVolume() - 10
        );
    }

    public function aumentarCanal()
    {
        $this->dispositivo->setCanal(
            $this->dispositivo->getCanal() + 1
        );
    }

    public function diminuirCanal()
    {
        $this->dispositivo->setCanal(
            $this->dispositivo->getCanal() - 1
        );
    }
}

class ControleRemotoAvancado extends ControleRemoto
{
    protected int $registradorDeVolume;

    public function toggleMudo()
    {
        $volumeAtual = $this->dispositivo->getVolume();

        if ($volumeAtual > 0) {
            // colocando no mudo
            $this->registradorDeVolume = $volumeAtual;
            $this->dispositivo->setVolume(0);
        } else {
            // tirando do mudo
            $this->dispositivo->setVolume($this->registradorDeVolume ?? 10);
        }

        echo "- Alterando volume do dispositivo para {$this->dispositivo->getVolume()}." . PHP_EOL;
    }
}

class TV implements Dispositivo
{
    public function __construct(
        protected bool $ligado = false,
        protected int $volume = 10,
        protected int $canal = 7
    ) {}

    public function isHabilitado()
    {
        return $this->ligado;
    }

    public function habilita()
    {
        $this->ligado = true;
    }

    public function desabilita()
    {
        $this->ligado = false;
    }

    public function getVolume()
    {
        return $this->volume;
    }

    public function setVolume($percentual)
    {
        $this->volume = $percentual;
    }

    public function getCanal()
    {
        return $this->canal;
    }

    public function setCanal($percentual)
    {
        $this->canal = $percentual;
    }
}

// Código cliente
$tvSamsung = new TV();
$controleSamsung = new ControleRemotoAvancado($tvSamsung);

$controleSamsung->toggleLigar();
$controleSamsung->aumentarVolume();
$controleSamsung->aumentarVolume();
$controleSamsung->aumentarVolume();

$controleSamsung->toggleMudo();
$controleSamsung->toggleMudo();

$controleSamsung->toggleLigar();
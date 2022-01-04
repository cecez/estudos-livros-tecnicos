<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php composite.php

interface Grafico
{
    public function mover(int $x, int $y);
    public function desenhar();
}

class Ponto implements Grafico
{
    public function __construct(
        public int $x,
        public int $y,
    ) {}

    public function mover(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function desenhar()
    {
        echo "($this->x, $this->y)";
    }
}

class GraficoComposto implements Grafico
{
    /** @var Grafico[] */
    public array $filhos;

    public function adiciona(Grafico $grafico)
    {
        $this->filhos[] = $grafico;
    }

    public function mover(int $x, int $y)
    {
        foreach ($this->filhos as $filho) {
            $filho->mover($x, $y);
        }
    }

    public function desenhar()
    {
        foreach ($this->filhos as $filho) {
            $filho->desenhar();
        }
    }
}

class EditorDeImagem
{
    public GraficoComposto $graficoComposto;

    public function carregar()
    {
        $this->graficoComposto = new GraficoComposto();
        $this->graficoComposto->adiciona(new Ponto(1,1));
        $this->graficoComposto->adiciona(new Ponto(2,2));
        $this->graficoComposto->adiciona(new Ponto(3,3));

        $subGrafico = new GraficoComposto();
        $subGrafico->adiciona(new Ponto(5,5));
        $subGrafico->adiciona(new Ponto(6,6));
        $this->graficoComposto->adiciona($subGrafico);
    }

    public function desenhar() {
        $this->graficoComposto->desenhar();
    }
}

$editor = new EditorDeImagem();
$editor->carregar();
$editor->desenhar();
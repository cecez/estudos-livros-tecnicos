<?php

// executar com Docker:
// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php factory.php

echo PHP_EOL;

interface Botao {
    public function renderiza();
    public function onClick();
}

class BotaoHTML implements Botao
{
    public string $titulo;

    public function renderiza(): string
    {
        return "<button>{$this->titulo}</button>";
    }

    public function onClick()
    {
        // TODO: Implement onClick() method.
    }
}

class BotaoVue implements Botao
{
    public string $titulo;

    public function renderiza(): string
    {
        return "<botao :titulo='{$this->titulo}'></botao>";
    }

    public function onClick()
    {
        // TODO: Implement onClick() method.
    }
}

abstract class Modal
{
    public readonly string $texto;
    public Botao $botaoOK;

    public function __construct() {
        $this->texto = 'Clique no botão abaixo';
        $this->botaoOK = $this->criaBotao();
    }

    abstract public function criaBotao(): Botao;
    public function renderiza()
    {
        echo $this->texto . PHP_EOL;

        $this->botaoOK->onClick();
        echo $this->botaoOK->renderiza();
    }
}

class ModalHTML extends Modal
{
    public function criaBotao(): Botao
    {
        return new BotaoHTML();
    }
}

class ModalVue extends Modal
{
    public function criaBotao(): Botao
    {
        return new BotaoVue();
    }
}

// Aplicação
$aplicacoes = ['html', 'vue'];
$aplicacao = $aplicacoes[rand(0, 1)];

$modal = null;
if ($aplicacao === 'html') {
    $modal = new ModalHTML();
} else if ($aplicacao === 'vue') {
    $modal = new ModalVue();
} else {
    throw new \Exception('Aplicação não suportada.');
}

$modal->botaoOK->titulo = 'Botão de OK';
$modal->renderiza();

echo PHP_EOL;
echo PHP_EOL;
<?php

// executar com Docker:
// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php abstract-factory.php

use JetBrains\PhpStorm\Pure;

interface Botao2
{
    public function renderiza();
}

interface Checkbox
{
    public function renderiza();
}

interface GUIFactory
{
    public function criaBotao(): Botao2;
    public function criaCheckbox(): Checkbox;
}

class HTMLFactory implements GUIFactory
{
    #[Pure] public function criaBotao(): Botao2
    {
        return new BotaoHTML2();
    }

    public function criaCheckbox(): Checkbox
    {
        return new CheckboxHTML();
    }
}

class VueFactory implements GUIFactory
{
    #[Pure] public function criaBotao(): Botao2
    {
        return new BotaoVue2();
    }

    public function criaCheckbox(): Checkbox
    {
        return new CheckboxVue();
    }
}

class BotaoHTML2 implements Botao2
{
    public function renderiza(): string
    {
        return '<button>Botão</button>';
    }
}

class BotaoVue2 implements Botao2
{
    public function renderiza(): string
    {
        return '<botao>Botão</botao>';
    }
}

class CheckboxHTML implements Checkbox
{
    public function renderiza(): string
    {
        return '<input type="checkbox" />Checkbox';
    }
}

class CheckboxVue implements Checkbox
{
    public function renderiza(): string
    {
        return '<checkbox>Checkbox</checkbox>';
    }
}

class Aplicativo
{
    private Botao2 $botao1;
    private Botao2 $botao2;
    private Checkbox $checkbox1;

    public function __construct(public GUIFactory $factory) {}

    public function inicializaUI()
    {
        $this->botao1 = $this->factory->criaBotao();
        $this->botao2 = $this->factory->criaBotao();
        $this->checkbox1 = $this->factory->criaCheckbox();
    }

    public function renderiza()
    {
        echo $this->botao1->renderiza() . PHP_EOL;
        echo $this->botao2->renderiza() . PHP_EOL;
        echo $this->checkbox1->renderiza() . PHP_EOL;
    }
}

// Aplicação
$aplicacoes = ['html', 'vue'];
$aplicacao = $aplicacoes[rand(0, 1)];

$factory = null;
if ($aplicacao === 'html') {
    $factory = new HTMLFactory();
} else if ($aplicacao === 'vue') {
    $factory = new VueFactory();
} else {
    throw new \Exception('Aplicação não suportada.');
}

$aplicativo = new Aplicativo($factory);
$aplicativo->inicializaUI();
$aplicativo->renderiza();

echo PHP_EOL;
echo PHP_EOL;
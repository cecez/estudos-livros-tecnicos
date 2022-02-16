<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php cor.php

interface ComponentWithContextualHelp
{
    public function showHelp();
}

abstract class Component implements ComponentWithContextualHelp
{
    public string $tooltipText;
    protected Container $container;
    public function showHelp()
    {
        if (!empty($this->tooltipText)) {
            echo "Exibindo tooltipText: {$this->tooltipText}";
            return;
        }
        $this->container->showHelp();
    }
}

abstract class Container extends Component
{
    /**
     * @var Component[]
     */
    protected array $children;

    public function add(Component $child)
    {
        $this->children[] = $child;
        $child->container = $this;
    }
}

class Dialog extends Container
{
    public string $wikiPageUrl;

    public function __construct(private string $titulo)
    {
    }

    public function showHelp()
    {
        if (!empty($this->wikiPageUrl)) {
            echo "[{$this->titulo}] Abrindo página de ajuda em: {$this->wikiPageUrl}";
            return;
        }
        parent::showHelp();
    }
}

class Panel extends Container
{
    public string $modalHelpText;
    public function __construct(private int $x, private int $y)
    {
    }

    public function showHelp()
    {
        if (!empty($this->modalHelpText)) {
            echo "[Em x:{$this->x} e y:{$this->y}] Exibindo modal de ajuda: {$this->modalHelpText}";
            return;
        }
        parent::showHelp();
    }
}

class Button extends Container
{
    public function __construct(private int $x, private int $y, private string $label)
    {
    }
}

// aplicação
//class Application
//{
//    public static function createUI()
//    {
        $dialog = new Dialog("Relatório de orçamento");
        $dialog->wikiPageUrl = "http://meajuda.com";

        $panel = new Panel(0,0);
        $panel->modalHelpText = "Me Ajuda neste modal.";

        $ok = new Button(1, 1, "OK");
        $ok->tooltipText = "Este botão de OK faz isso.";

        $cancel = new Button(2, 2, "Cancelar");

        $panel->add($ok);
        $panel->add($cancel);

        $dialog->add($panel);
//    }
//}
//
//Application::createUI();

// simulando chamada para ajuda em um component
// $componente = encontraComponenteClicado();
$componente = $ok;
$componente->showHelp();    // deve exibir a ajuda do componente (modal no caso)

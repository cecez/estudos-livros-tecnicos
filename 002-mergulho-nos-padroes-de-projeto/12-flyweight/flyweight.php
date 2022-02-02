<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php flyweigth.php

// A classe flyweight contém uma parte do estado de uma árvore
// Esses campos armazenam valores que são únicos para cada
// árvore em particular. Por exemplo, você não vai encontrar
// coordenadas da árvore aqui. Já que esses dados geralmente são
// GRANDES, você gastaria muita memória mantendo-os em cada
// objeto árvore. Ao invés disso, nós podemos extrair a textura,
// cor e outros dados repetitivos em um objeto separado os quais
// muitas árvores individuais podem referenciar.”
class TreeType
{
    public function __construct(private $name, private $color, private $texture) {}

    public function draw($canvas, $x, $y)
    {
        $bitmap = $this->name . $this->color . $this->texture;
        // desenha bitmap na tela
    }
}

class TreeFactory
{
    public static array $treeTypes;

    public static function getTreeType($name, $color, $texture)
    {
        // busca no array/coleção de itens
        $type = self::$treeTypes[$name.$color.$texture];
        if (is_null($type)) {
            $type = new TreeType($name, $color, $texture);
            self::$treeTypes[$name.$color.$texture] = $type;
        }
        return $type;
    }
}

// parte extrínsica
class Tree
{
    public function __construct(private $x, private $y, private TreeType $type) {}

    public function draw($canvas)
    {
        $this->type->draw($canvas, $this->x, $this->y);
    }

}

// As classes Tree (Árvore) e Forest (Floresta) são os clientes
// flyweight. Você pode uni-las se não planeja desenvolver mais
// a classe Tree.
class Forest
{
    /**
     * @var Tree[]
     */
    private array $trees;

    public function plantTree($x, $y, $name, $color, $texture)
    {
        $type = TreeFactory::getTreeType($name, $color, $texture);
        $tree = new Tree($x, $y, $type);
        $this->trees[] = $tree;
    }

    public function draw($canvas)
    {
        foreach ($this->trees as $tree) {
            $tree->draw($canvas);
        }
    }
}

$canvas = [];

$floresta = new Forest();
$floresta->plantTree(1, 1, "tree1", "verde", "plátano");
$floresta->plantTree(2, 2, "tree2", "roxa", "bananeira");
$floresta->draw($canvas);
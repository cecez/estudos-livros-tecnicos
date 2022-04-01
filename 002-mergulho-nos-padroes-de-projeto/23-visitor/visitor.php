<?php

// O elemento interface declara um método "accept" que toma a interface do visitante base como argumento.
interface Shape {
    public function move($x, $y);
    public function draw();
    public function accept(Visitor $visitor);
}

class Dot implements Shape {

    public function accept(Visitor $visitor)
    {
        $visitor->visitDot($this);
    }

    public function move($x, $y)
    {
        // TODO: Implement move() method.
    }

    public function draw()
    {
        // TODO: Implement draw() method.
    }
}

class Circle implements Shape {

    public function accept(Visitor $visitor)
    {
        $visitor->visitCircle($this);
    }

    public function move($x, $y)
    {
        // TODO: Implement move() method.
    }

    public function draw()
    {
        // TODO: Implement draw() method.
    }
}

class Rectangle implements Shape {

    public function accept(Visitor $visitor)
    {
        $visitor->visitRectangle($this);
    }

    public function move($x, $y)
    {
        // TODO: Implement move() method.
    }

    public function draw()
    {
        // TODO: Implement draw() method.
    }
}

class CompoundShape implements Shape {

    public function accept(Visitor $visitor)
    {
        $visitor->visitCompoundShape($this);
    }

    public function move($x, $y)
    {
        // TODO: Implement move() method.
    }

    public function draw()
    {
        // TODO: Implement draw() method.
    }
}

interface Visitor {
    public function visitDot(Dot $dot);
    public function visitCircle(Circle $circle);
    public function visitRectangle(Rectangle $rectangle);
    public function visitCompoundShape(CompoundShape $compoundShape);
}

class XMLExportVisitor implements Visitor
{
    public function visitCircle(Circle $circle)
    {
        // exporta a id do circle, coordenadas do centro e raio.
    }

    public function visitRectangle(Rectangle $rectangle)
    {
        // TODO: Implement visitRectangle() method.
    }

    public function visitCompoundShape(CompoundShape $compoundShape)
    {
        // TODO: Implement visitCompoundShape() method.
    }

    public function visitDot(Dot $dot)
    {
    }
}

// Aplicação
$shapes = [
    new Dot(),
    new Circle(),
    new Rectangle(),
    new CompoundShape()
];

// exportação XML
$exportVisitor = new XMLExportVisitor();
foreach ($shapes as $shape) {
    $shape->accept($exportVisitor);
}
<?php

interface Strategy {
    public function execute(int $a, int $b): int;
}

class ConcreteStrategyAdd implements Strategy {

    public function execute(int $a, int $b): int
    {
        return $a + $b;
    }
}

class ConcreteStrategySubtract implements Strategy {

    public function execute(int $a, int $b): int
    {
        return $a - $b;
    }
}

class ConcreteStrategyMultiply implements Strategy {

    public function execute(int $a, int $b): int
    {
        return $a * $b;
    }
}

class Context {
    private Strategy $strategy;

    public function changeStrategy(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy(int $a, int $b): int
    {
        return $this->strategy->execute($a, $b);
    }
}

// Aplicação
$context = new Context();
$numberA = 3;
$numberB = 4;
$operation = 'multiply';

// ifs para operation
if ($operation === 'multiply') {
    $context->changeStrategy(new ConcreteStrategyMultiply());
}

echo $context->executeStrategy($numberA, $numberB);
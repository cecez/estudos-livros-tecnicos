<?php

abstract class GameAI {
    // O método padrão define o esqueleto do algoritmo de IA.
    public function turn()
    {
        $this->collectResources();
        $this->buildStructures();
        $this->buildUnits();
        $this->attack();
    }

    // Algumas etapas serão implementadas diretamente na classe base.
    protected function collectResources()
    {
        foreach ($this->buildStructures() as $structure) {
            $structure->collect();
        }
    }

    abstract function buildStructures();
    abstract function buildUnits();
    abstract function sendScouts($position);
    abstract function sendWarriors($position);

    protected function attack()
    {
        $enemy = $this->closestEnemy();
        if (is_null($enemy)) {
            $this->sendScouts($this->map->center());
        } else {
            $this->sendWarriors($enemy->position());
        }
    }
}

class OrcsAI extends GameAI {
    public function buildStructures()
    {
        return [
            new Barracks(),
            new Stable(),
        ];
    }

    public function buildUnits()
    {
        return [
            new Archer(),
            new Warrior(),
        ];
    }

    public function sendScouts($position)
    {
        $this->units->add(new Scout($position));
    }

    public function sendWarriors($position)
    {
        $this->units->add(new Warrior($position));
    }
}

class MonstersAI extends GameAI {

    public function collectResources()
    {
        // Monstros não coletam recursos.
    }

    function buildStructures()
    {
        // Monstros não construem estruturas.
    }

    function buildUnits()
    {
        // Monstros não construem unidades.
    }

    function sendScouts($position)
    {
        // Monstros não enviam batedores.
    }

    function sendWarriors($position)
    {
        // Monstros não enviam guerreiros.
    }
}
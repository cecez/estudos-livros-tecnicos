<?php

// Esta classe age como um contexto e também mantém uma referência 
// para uma instância de uma das classes de estado que representa 
// o atual estado do player.
class AudioPlayer {
    private State $state;
    private $ui, $volume, $playList;
    private string $currentSong = "";

    public function __construct()
    {
        $this->state = new ReadyState($this);
        
        $ui = new UI();
        $ui->lockButton->onClick($this->clickLock());
        $ui->playButton->onClick($this->clickPlay());
        $ui->nextButton->onClick($this->clickNext());
        $ui->previousButton->onClick($this->clickPrevious());
    }

    // - Métodos de UI delegam a execução para o estado ativo.

    private function clickLock()
    {
        $this->state->clickLock();
    }

    private function clickPlay()
    {
        $this->state->clickPlay();
    }

    private function clickNext()
    {
        $this->state->clickNext();
    }

    private function clickPrevious()
    {
        $this->state->clickPrevious();
    }

    // Outros objetos devem ser capazes de trocar o estado ativo do player.
    public function changeState(State $state) {
        $this->state = $state;
    }

    // Um estado pode chamar alguns métodos de serviço no contexto.
    public function isPlaying(): bool
    {
        return $this->currentSong === "";
    }
    public function startPlayback() {}
    public function stopPlayback() {}
    public function nextSong() {}
    public function previousSong() {}
    // ...
}

abstract class State {
    protected AudioPlayer $player;

    public function __construct($player)
    {
        $this->player = $player;
    }

    abstract function clickLock();
    abstract function clickPlay();
    abstract function clickNext();
    abstract function clickPrevious();
}

class LockState extends State {

    function clickLock()
    {
        if ($this->player->isPlaying()) {
            $this->player->changeState(new PlayingState($this->player));
        } else {
            $this->player->changeState(new ReadyState($this->player));
        }
    }

    function clickPlay()
    {
        // nada
    }

    function clickNext()
    {
        // nada
    }

    function clickPrevious()
    {
        // nada
    }
}

class ReadyState extends State {

    function clickLock()
    {
        $this->player->changeState(new LockState($this->player));
    }

    function clickPlay()
    {
        $this->player->startPlayback();
        $this->player->changeState(new PlayingState($this->player));
    }

    function clickNext()
    {
        $this->player->nextSong();
    }

    function clickPrevious()
    {
        $this->player->previousSong();
    }
}

class PlayingState extends State {

    function clickLock()
    {
        $this->player->changeState(new LockState($this->player));
    }

    function clickPlay()
    {
        $this->player->stopPlayback();
        $this->player->changeState(new ReadyState($this->player));
    }

    function clickNext()
    {
        if (doubleClick()) {
            $this->player->fastForward(5);
        } else {
            $this->player->nextSong();
        }
    }

    function clickPrevious()
    {
        // TODO: Implement clickPrevious() method.
    }
}


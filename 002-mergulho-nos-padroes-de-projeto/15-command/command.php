<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php command.php

abstract class Command {
    protected $app;
    protected $editor;
    protected $backup;

    public function __construct($app, $editor)
    {
        $this->app = $app;
        $this->editor = $editor;
    }

    public function saveBackup()
    {
        $this->backup = $this->editor->text;
    }

    public function undo()
    {
        $this->editor->text = $this->backup;
    }
    
    // Método de execução declarado abstrato para forçar a implementação pelos comandos concretos.
    // Deve retornar true/false dependendo se comando muda o estado do editor. 
    abstract public function execute(): bool;
}

class CopyCommand extends Command {
    public function execute(): bool
    {
        $this->app->clipboard = $this->editor->getSelection();
        return false;
    }
}

class CutCommand extends Command {
    public function execute(): bool
    {
        $this->saveBackup();
        $this->app->clipboard = $this->editor->getSelection();
        $this->editor->deleteSelection();
        return true;
    }
}

class PasteCommand extends Command {
    public function execute(): bool
    {
        $this->saveBackup();
        $this->editor->replaceSelection($this->app->clipboard);
        return true;
    }
}

class UndoCommand extends Command {
    public function execute(): bool
    {
        $this->undo();
        return false;
    }
}

class CommandHistory {
    /** @var Command[]  */
    private array $history;

    public function push(Command $command)
    {
        $this->history[] = $command;
    }

    public function pop(): Command
    {
        return array_pop($this->history);
    }
}

class Editor {
    public string $text;

    public function getSelection()
    {
        
    }

    public function deleteSelection()
    {
        
    }

    public function replaceSelection($text)
    {
        
    }
}

class Application {
    public string $clipboard;
    public array $editors;
    public Editor $activeEditor;
    public CommandHistory $commandHistory;

    public function executeCommand(Command $command)
    {
        if ($command->execute()) {
            $this->commandHistory->push($command);
        }
    }

    public function undo()
    {
        $command = $this->commandHistory->pop();
        if (is_a($command, Command::class)) {
            $command->undo();
        }
    }

    public function createUI()
    {
        $copy = function () {
            $this->executeCommand(new CopyCommand($this, $this->activeEditor));
        };
        $copyButton = new Button();
        $copyButton->setCommand($copy);
        $shortcuts->onKeyPress("Ctrl+C", $copy);

        ///...
    }
}
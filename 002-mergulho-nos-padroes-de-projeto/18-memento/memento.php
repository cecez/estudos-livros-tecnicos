<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php memento.php

class Editor {
    private $text, $curX, $curY, $selectionWidth;

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setCursor($x, $y)
    {
        $this->curX = $x;
        $this->curY = $y;
    }

    public function setSelectionWidth($width)
    {
        $this->selectionWidth = $width;
    }

    public function createSnapshot(): Snapshot
    {
        return new Snapshot($this, $this->text, $this->curX, $this->curY, $this->selectionWidth);
    }
}

class Snapshot {
    private Editor $editor;
    private $text, $curX, $curY, $selectionWidth;

    public function __construct($editor, $text, $x, $y, $width)
    {
        $this->editor = $editor;
        $this->text = $text;
        $this->curX = $x;
        $this->curY = $y;
        $this->selectionWidth = $width;
    }

    public function restore()
    {
        $this->editor->setText($this->text);
        $this->editor->setCursor($this->curX, $this->curY);
        $this->editor->setSelectionWidth($this->selectionWidth);
    }
}

class Command2 {
    private ?Snapshot $backup = null;
    private Editor $editor;

    public function __construct($editor)
    {
        $this->editor = $editor;
    }

    public function makeBackup()
    {
        $this->backup = $this->editor->createSnapshot();
    }

    public function undo()
    {
        if (!is_null($this->backup)) {
            $this->backup->restore();
            $this->backup = null;
        }
    }
}

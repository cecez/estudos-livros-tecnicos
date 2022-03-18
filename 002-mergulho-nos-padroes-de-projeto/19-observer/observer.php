<?php

// Interface do subscriber
interface EventListener {
    public function update($filename);
}

class EventManager {
    private $listeners;

    public function subscribe($eventType, EventListener $listener)
    {
        $this->listeners->add($eventType, $listener);
    }

    public function unsubscribe($eventType, EventListener $listener)
    {
        $this->listeners->remove($eventType, $listener);
    }

    public function notify($eventType, $data)
    {
        foreach ($this->listeners->of($eventType) as $listener) {
            $listener->update($data);
        }
    }
}

// Publisher concreto
// Neste caso, composta com a lógica de inscrição (EventManager)
class Editor2 {
    public EventManager $events;
    private $file;

    public function __construct()
    {
        $this->events = new EventManager();
    }

    public function openFile($path)
    {
        $this->file = new File($path);
        $this->events->notify("open", $this->file->name);
    }

    public function saveFile()
    {
        $this->file->write();
        $this->events->notify("save", $this->file->name);
    }
}

// Subscribers concretos
class LoggingListener implements EventListener {
    private $logFile;
    private string $message;

    public function __construct($logFileName, $message)
    {
        $this->logFile = new File($logFileName);
        $this->message = $message;
    }

    public function update($filename)
    {
        $this->logFile->write(str_replace("%s", $filename, $this->message));
    }
}

class EmailAlertListener implements EventListener {
    private string $email;
    private string $message;

    public function __construct($email, $message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    public function update($filename)
    {
        mail($this->email, "Alerter", str_replace("%s", $filename, $this->message));
    }
}

// Aplicação
$editor = new Editor2();
$logger = new LoggingListener("log.txt", "Alguém abriu o arquivo %s.");
$editor->events->subscribe("open", $logger);
$alerter = new EmailAlertListener("email@email.com", "Alguém salvou o arquivo %s.");
$editor->events->subscribe("save", $alerter);
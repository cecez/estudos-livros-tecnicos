<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php mediator.php

interface Mediator {
    public function notify(Component2 $sender, string $event);
}

class AuthenticationDialog implements Mediator {
    private string $title;
    private Checkbox $loginOrRegisterCheckbox;
    private Textbox $loginUsername, $loginPassword, $registrationUsername, $registrationPassword, $registrationEmail;
    private Button2 $okButton, $cancelButton;

    public function __construct()
    {
        // cria todos os objetos componentes e passa o atual mediador em seus construtores para estabelecer o vínculo.

        // quando algo acontecer com um componente, ele notifica o mediador. Ao receber a notificação, o mediador pode fazer alguma coisa por conta própria ou passar o pedido para outro componente.
    }

    public function notify(Component2 $sender, string $event)
    {
        if ($sender === $this->loginOrRegisterCheckbox && $event === "check") {
            if ($this->loginOrRegisterCheckbox->isChecked()) {
                $this->title = "Log in";
            } else {
                $this->title = "Register";
            }
            return;
        }

        if ($sender === $this->okButton && $event === "click") {
            if ($this->loginOrRegisterCheckbox->isChecked()) {
                // lógica...
            }
        }
    }
}

class Component2 {
    public function __construct(protected Mediator $dialog) {}
    public function click()
    {
        $this->dialog->notify($this, "click");
    }
}
class Textbox extends Component2 {}
class Button2 extends Component2 {}
class Checkbox extends Component2 {
    protected bool $checked = false;
    public function check()
    {
        $this->dialog->notify($this, "check");
    }

    public function isChecked()
    {
        return $this->checked;
    }
}
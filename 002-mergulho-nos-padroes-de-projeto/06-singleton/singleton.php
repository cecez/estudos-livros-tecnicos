<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php singleton.php

class ConexaoBancoDeDados
{
    public static ?ConexaoBancoDeDados $instancia;

    public function __construct(
        public string $nome
    ) {}

    public static function getInstance(): ConexaoBancoDeDados
    {
        if (!isset(self::$instancia)) {
            self::$instancia = new ConexaoBancoDeDados('eins');
            echo PHP_EOL . '-- criando primeira instância --' . PHP_EOL;
        }

        return self::$instancia;
    }
}

$conexao = ConexaoBancoDeDados::getInstance();
$conexao2 = ConexaoBancoDeDados::getInstance();
var_dump($conexao);
var_dump($conexao2);
var_dump($conexao === $conexao2);

<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php facade.php

class Video {}
class CompressaoDeCodec {}
class LeitorDeBitRate {}
class MixadorDeAudio {}

// Classe "fachada" para esconder a complexidade do framework atrás de uma "interface" simples.
class ConversorDeVideoFacade {
    public static function converte($arquivo, $formato) {
        // utiliza diversas classes para realizar ação.
    }
}

// As classes da aplicação não dependem de um bilhão de classes fornecidas por um framework complexo.
// Além disso, se precisar trocar de framework, só precisa reescrever a classe fachada.
// Aplicação
ConversorDeVideoFacade::converte("teste.mov", "avi");
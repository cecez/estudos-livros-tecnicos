<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php decorator.php

interface DataSource
{
    public function writeData($data);
    public function readData();
}

class FileDataSource implements DataSource
{
    public function __construct(
        public $filename
    ) {}

    public function writeData($data)
    {
        file_put_contents($this->filename, $data);
    }

    public function readData(): bool|string
    {
        return file_get_contents($this->filename);
    }
}

class DataSourceDecorator implements DataSource
{
    protected DataSource $wrapee;

    public function __construct(DataSource $dataSource) {
        $this->wrapee = $dataSource;
    }

    public function writeData($data)
    {
        $this->wrapee->writeData($data);
    }

    public function readData()
    {
        return $this->wrapee->readData();
    }
}

class EncryptionDecorator extends DataSourceDecorator
{
    const CIPHERING = "AES-128-CTR";
    const IV = '1234567891011121';
    const KEY = "GeeksforGeeks";

    public function writeData($data)
    {
        $dadosEncriptados = openssl_encrypt(
            $data,
            self::CIPHERING,
            self::KEY,
            0,
            self::IV
        );
        $this->wrapee->writeData($dadosEncriptados);
    }

    public function readData()
    {
        return openssl_decrypt(
            $this->wrapee->readData(),
            self::CIPHERING,
            self::KEY,
            0,
            self::IV
        );
    }
}

class CompressionDecorator extends DataSourceDecorator
{
    public function writeData($data)
    {
        $dadosComprimidos = base64_encode($data);
        $this->wrapee->writeData($dadosComprimidos);
    }

    public function readData(): bool|string
    {
        return base64_decode($this->wrapee->readData());
    }
}

// comprime, encripta e salva
$arquivoBase = new FileDataSource("testinho.txt");
$encriptador = new EncryptionDecorator($arquivoBase);
$compressor = new CompressionDecorator($encriptador);
$compressor->writeData("texto simples, que será encriptado e comprimido.");

echo "dados salvos (comprimido e encriptado): " . $arquivoBase->readData() . PHP_EOL;
echo "busca dados do disco, decripta e descomprime: " . $compressor->readData() . PHP_EOL;

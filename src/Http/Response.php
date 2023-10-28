<?php

namespace App\Http;

use League\Plates\Engine as Engine;
use League\Plates\Extension\Asset as Asset;

class Response
{
    private $tplEngie;

    public function __construct()
    {
        $this->tplEngie = new Engine(__DIR__ . "/../../app/views");
        $this->tplEngie->loadExtension(new Asset(__DIR__ . "/../../public/", false));
        $this->tplEngie->addFolder("layouts", __DIR__ . "/../../app/views/layouts");
    }

    public function status(int $statusCode): self
    {
        http_response_code($statusCode);
        return $this;
    }

    public function json(array $obj = []): void
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($obj);
    }

    public function send(string $any = ""): void
    {
        echo $any;
    }

    public function render(string $path, array $data = [])
    {
        try {
            echo $this->tplEngie->render($path, $data);
        } catch (\Exception $error) {
            throw new \Exception("file '$path' not found in view");
        }
    }
}

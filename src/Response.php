<?php

namespace App;

use League\Plates\Engine as Engine;

class Response
{
    private $tplEngie;

    public function __construct()
    {
        $this->tplEngie = new Engine("app/views");
        $this->tplEngie->addFolder("layouts", "app/views/layouts");
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

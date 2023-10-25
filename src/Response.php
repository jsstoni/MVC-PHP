<?php

namespace App;

use League\Plates\Engine as Engine;

class Response
{
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

    public function render(string $path, array $data = []): void
    {
        $tpl = new Engine('app/views');
        $tpl->addFolder("layouts", "app/views/layouts");
        echo $tpl->render($path, $data);
    }
}

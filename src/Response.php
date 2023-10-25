<?php

namespace App;

use League\Plates\Engine as Engine;

class Response
{
    public function status($statusCode)
    {
        http_response_code($statusCode);
        return $this;
    }

    public function json($obj = [])
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($obj);
    }

    public function send($any = "")
    {
        echo $any;
    }

    public function render($path, $data = [])
    {
        $tpl = new Engine('app/views');
        $tpl->addFolder("layouts", "app/views/layouts");
        echo $tpl->render($path, $data);
    }
}

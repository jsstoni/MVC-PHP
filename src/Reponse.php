<?php

namespace App;

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
    }

    public function render($template, $data = [])
    {
    }
}

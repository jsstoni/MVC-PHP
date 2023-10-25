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
    }

    public function send($any = "")
    {
    }

    public function render($template, $data = [])
    {
    }
}

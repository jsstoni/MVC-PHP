<?php

namespace App;

use App\Helper;

class Request
{
    private $params = array();
    private $contentType = "";

    public function __construct()
    {
        $body = file_get_contents('php://input');
        $this->contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $this->params['query'] = $_GET ?? [];
        if ($this->contentType === "application/x-www-form-urlencoded" || strpos($this->contentType, 'multipart/form-data') !== false) {
            $this->processRequest($body);
        } else if ($this->contentType === 'application/json') {
            $this->params['body'] = json_decode($body, true);
        }
    }

    public function getToken()
    {
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $token = null;
            $authorizationHeader = $headers['Authorization'];
            $bearerPrefix = 'Bearer ';
            if (substr($authorizationHeader, 0, strlen($bearerPrefix)) === $bearerPrefix) {
                $token = substr($authorizationHeader, strlen($bearerPrefix)); // Obtener el token Bearer
            }
            return Helper::decodeToken($token);
        }
    }

    public function processRequest($body)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'PUT' || $method == 'DELETE') {
            //procesando
        } else {
            $this->params['body'] = $_POST;
            $this->params['files'] = $_FILES;
        }
    }

    public function setParams($params, $k = '')
    {
        if (is_array($params)) {
            foreach ($params as $key => $value) {
                $this->params['params'][$key] = $value;
            }
        } else {
            $this->params['params'][$k] = $params;
        }
    }

    public function body()
    {
        return json_decode(json_encode($this->params['body'] ?? []));
    }

    public function query()
    {
        return json_decode(json_encode($this->params['query'] ?? []));
    }

    public function params()
    {
        return json_decode(json_encode($this->params['params'] ?? []));
    }

    public function files()
    {
        return json_decode(json_encode($this->params['files'] ?? []));
    }

    public function getParams()
    {
        $params = new \stdClass();
        $params->body = $this->body();
        $params->query = $this->query();
        $params->param = $this->params();
        $params->file = $this->files();
        $params->authorization = $this->getToken();
        return $params;
    }
}

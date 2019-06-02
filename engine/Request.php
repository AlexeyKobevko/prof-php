<?php


namespace app\engine;


class Request
{
    private $requestString;
    private $controllerName;
    private $actionName;
    private $method;
    private $params;


    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
    }


    private function parseRequest() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $url = explode('/', $this->requestString);

        $this->controllerName = $url[1];
        $this->actionName = $url[2];
        $this->params = $_REQUEST;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParams()
    {
        return $this->params;
    }


}
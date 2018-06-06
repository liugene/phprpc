<?php

namespace phprpc\protocol;

class Request
{

    /**
     * 请求id
     * @var
     */
    private $request_id;

    private $token;

    private $service;

    private $action;

    private $method;

    private $parameters;

    /**
     * Request constructor.
     * @param string $requestId 针对链式调用，继承上游 requestId
     */
    public function __construct($requestId = false)
    {
        if ($requestId) {
            $this->request_id = $requestId;
        }else{
            $this->createRequestId();
        }
    }

    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function setParamters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    private function createRequestId()
    {
        $this->request_id = md5(uniqid(mt_rand(1, 1000000), true));
    }

}
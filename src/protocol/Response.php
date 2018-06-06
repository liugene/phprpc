<?php

namespace phprpc\protocol;

class Response
{

    private $request_id;

    private $code;

    private $body;

    private $message;

    public function setResponseId($requestId)
    {
        $this->request_id = $requestId;
        return $this;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

}
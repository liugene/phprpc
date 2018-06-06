<?php

namespace phprpc;

use linkphp\Exception;

class PhpRpcCustomer
{

    private $config_path;

    private $customer_service = [];

    public function setConfigPath($path)
    {
        $this->config_path = $path;
        return $this;
    }

    public function setCustomerService($services)
    {
        $this->customer_service = $services;
        return $this;
    }

    public function getCustomerService($service)
    {
        if(isset($this->customer_service[$service]))return $this->customer_service[$service];
        throw new Exception('不存在服务');
    }

}
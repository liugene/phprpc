<?php

namespace phprpc;

use linkphp\Exception;

class PhpRpcProvider
{

    private $config_path;

    private $provider_service = [];

    public function setConfigPath($path)
    {
        $this->config_path = $path;
        return $this;
    }

    public function setProviderService($services)
    {
        $this->provider_service = $services;
        return $this;
    }

    public function getProviderService($service)
    {
        if(isset($this->provider_service[$service]))return $this->provider_service[$service];
        throw new Exception('不存在服务');
    }

}
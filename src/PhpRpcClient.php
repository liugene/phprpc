<?php

namespace phprpc;

use linkphp\swoole\Client;
use phprpc\control\Dispatch;

class PhpRpcClient extends Client
{

    private $serviceName;

    private $url;

    private $service;

    private $services = [];

    public function __construct($serviceName,$timeout = 500, $retry = 3)
    {
        $this->serviceName = $serviceName;
        if(isset($this->services[$serviceName])) return $this;

        try {
            $service = Dispatch::getService($serviceName);
            $this->setHost($service['ip'])->setPort($service['port'])->start();
            $this->services[$serviceName] = $this->_client;
        } catch (\Exception $e) {
            $retry--;
        }
    }

    public function onReceive()
    {
        $this->_client->on("receive", function(Client $cli, $data){
            echo "Receive: $data";
            $cli->send(str_repeat('A', 100)."\n");
            sleep(1);
        });
    }

    public function onClose()
    {
        $this->_client->on("close", function(Client $cli){
            echo "Connection close\n";
        });
    }

    public function __call($action, $arguments)
    {
        // TODO: Implement __call() method.
        $content = json_encode($arguments);
        $options['http'] = [
            'timeout' => 5,
            'method' => 'POST',
            'header' => '',
            'content' => $content
        ];
        $context = stream_context_create($options);
        $get = [
            'service' => $this->service,
            'action'  => $action
        ];
        $url = $this->url . '?' . http_build_query($get);
        $res = file_get_contents($url, true, $context);
    }

}
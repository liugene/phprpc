<?php

namespace phprpc\protocol;

class Packet
{

    public static function pack($request)
    {
        $msg = json_encode($request,true);
        return pack('N', strlen($msg)) . $msg;
    }

    public static function unpack($data)
    {
        $head = unpack('N', substr($data, 0 , 4)); // 获取包头
        $body = substr($data, 4);  // 获取数据
        return ['header' => $head, 'body' => json_decode($body,true)];
    }

}
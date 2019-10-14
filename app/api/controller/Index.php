<?php
namespace app\api\controller;

class Index
{
    public function index()
    {
        $url = domain_name().'/admin';
        header('HTTP/1.1 301 Moved Permanently');
        header("location:$url");
        exit();
    }
}

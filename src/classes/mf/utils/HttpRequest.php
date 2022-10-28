<?php

namespace iutnc\mf\utils;

class HttpRequest extends AbstractHttpRequest{
    
    public function __construct()
    {
        $this->script_name = $_SERVER['SCRIPT_NAME'];
        $this->path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : null;
        $this->root = rtrim(dirname($_SERVER['SCRIPT_NAME']), "/");
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->get = $_GET;
        $this->post = $_POST;
    }
}   
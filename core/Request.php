<?php


class Request
{
    /**
     * @var mixed
     * Get URL typing by user
     */
    public  $url;
    public $controller;
    public $action;

    # the rest of the params after controller and action for example (id, slug)
    public $params;

    function __construct()
    {
        $this->url = $_SERVER['PATH_INFO'];
    }
}
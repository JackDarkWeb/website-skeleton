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
    /**
     * @var float
     */
    public $page = 1;

    function __construct()
    {
        $this->url = $_SERVER['PATH_INFO'];

        #Paginte
        if(isset($_GET['page'])){
            
            if(is_numeric($_GET['page'])){

                if($_GET['page'] > 0)
                  $this->page = round($_GET['page']);
            }
        }
    }
}
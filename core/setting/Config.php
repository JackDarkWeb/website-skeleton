<?php


class Config
{
    static $debug = 1;

    static $databases = [
        'dev' => [
            'host' => '127.0.0.1',
            'dbname' => 'site',
            'user' => 'root',
            'password' => ''
        ],

        'production' => [
            'host' => '',
            'dbname' => '',
            'user' => '',
            'password' => ''
        ]
    ];


}

Router::connect('post/:slug-:id', "post/read/id:([0-9]+)/slug:([a-zA-Z0-9\-]+)");
<?php

spl_autoload_register(function ($class){
    require_once ROOT.DS.'Models'.DS.$class.'.php';
});



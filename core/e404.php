<?php
function e404($message = []){

    header('HTTP//1.0 404 not found');

    extract($message);
    require 'views/errors/404.php';
    die();
}
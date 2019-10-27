<?php


class HomeController extends Controller
{
    function welcome(){
        $this->render('home.welcome');
    }
}
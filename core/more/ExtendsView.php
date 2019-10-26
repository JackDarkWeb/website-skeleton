<?php


class ExtendsView
{

    /**
     * @param $view
     * @return false|string
     */
    static function extend($view){

        $view = ROOT.DS.'Views'.DS.'layout'.DS.$view.'.php';

        ob_start();
        require $view;

        $content = ob_get_clean();

        return $content;
    }
}
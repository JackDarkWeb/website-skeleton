<?php


class Controller
{
    public $request;
    private $vars     = [],

        # Know If the view has already been rendered
        $rendered = false;



    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @param $view
     * @param array $data
     * @return bool
     */
    public function render($view, $data = []){

        if(!$this->rendered){

            $this->make($view, $data);
            $this->rendered = true;
        }
        return $this->rendered;
    }

    /**
     * @param $view
     * @param array $data
     */
    private function make($view, $data = []){

        foreach ($data as $key => $val){
            $this->vars[$key] = $val;
        }
        extract($this->vars);


        if(strpos($view, '/') === 0){

            $view = ROOT.DS.'views'.$view.'.php';
        }else{

            $trans_view = str_replace('.', DS, $view);
            $view = ROOT.DS.'views'.DS.$trans_view.'.php';
        }

        ob_start();

        require($view);

        $yield = ob_get_clean();
        require ROOT.DS.'views'.DS.'layouts'.DS.'default.php';
        //die($view);
    }

    /**
     * @param $message
     */
    function e404($message){
        header('HTTP//1.0 404 not found');
        $this->render('/errors/404', [
            'message' => $message
        ]);
        die();
    }

    /**
     * @param $name
     * @return mixed
     */
    function loadModel($name){

        $file = ROOT.DS.'Models'.DS.$name.'.php';
        require_once $file;

        // Load the file once if it has not already been loaded
        if(!isset($this->name)){
            $this->name = new $name();
        }
    }

}
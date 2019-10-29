<?php


class Router
{
    static $routes = [];

    /**
     * @param $url
     * @param $request
     * @return bool
     * Allows parser url to be retrieved by the Request object to Dispatcher object
     */
    static function parse($url, $request)
    {

        $url = trim($url, '/');
        $params = explode('/', $url);


        /*if($params[0] === ""){
            $request->controller = 'home';
            $request->action = 'welcome';
            $request->params = array();
        //}else{*/

            $request->controller = $params[0];
            $request->action = isset($params[1]) ? $params[1] : 'index';
            $request->params = array_slice($params, 2);
        //}

                        /*
                         $params = [
                            'controller' => $detach[0],
                            'action' => isset($detach[1]) ? $detach[1] : 'index',
                        ];
                        $params['params'] = array_slice($params, 2); // le reste des params apres controller et action
                        //print_r($params);
                        return $params
                        */
        return true;
    }


    static function connect($redir, $url){
        $r = [];

        $r['redir'] = $redir;
        $r['origin'] = preg_replace('/([a-zA-Z0-9]+):([^\/]+)/', '${1}:(?P<${1}>${2})', $url);
        $r['origin'] = '/'.str_replace('/', '\/', $r['origin']).'/';
        self::$routes[] = $r;
        dd($r);
    }

    static function url($url){

        foreach (self::$routes as $value){

            if(preg_match($value['origin'], $url, $match)){

                foreach ($match as $key => $val){

                    if(!is_numeric($key)){

                        $value['redir'] = str_replace(":$key", $val, $value['redir']);
                    }
                }

                return $value['redir'];
                //dd($match);
            }
        }
        return $url;
    }

}
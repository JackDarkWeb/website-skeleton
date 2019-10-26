<?php


class Router
{
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


        if($params[0] === ""){
            $request->controller = 'home';
            $request->action = 'welcome';
            $request->params = array();
        }else{

            $request->controller = $params[0];
            $request->action = isset($params[1]) ? $params[1] : 'index';
            $request->params = array_slice($params, 2);
        }

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

}
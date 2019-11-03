<?php

function assets($file){

    $file = str_replace('.', DS, $file);
    $detach = explode(DS, $file);

    if(sizeof($detach) >= 2){

        $folder   = $detach[0];
        $file     = $detach[1];
        $folders  = scandir(PUBLIC_FOLDER);

        if(in_array($folder, $folders)){
            

            $f        = scandir($folder);
            $new_f    = [];

            foreach ($f as $value){

                if(strlen($value) > 3){
                    $new_f[] = $value;
                }
            }
            $extension_file = end(explode('.', $new_f[0]));


            if(in_array($file.'.'.$extension_file, $new_f))
                return DS.'public'.DS.$folder.DS.$file.'.'.$extension_file;
            else
                return DS.'public'.DS.$file.'.'.$extension_file;



        }else
            return 'false';
    }
    return false;
}

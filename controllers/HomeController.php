<?php


class HomeController extends Controller
{
    function welcome(){
        $this->view('home.welcome');
    }

    function create(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $files = $this->upload_multiple_files('file');
            dump($files);
        }

        return $this->view('home.upload');
    }


    function search(){

        $home = new Home();

        if($_POST['ajax'] == true){

            $str = $this->post('search');
            $get = $home->search('title', $str);

            $data = [];

            if(count($get) > 0){


                foreach ($get as $value){

                    $data[] ='<li><a href="'.$value->id.'">'. $value->title.'</a> </li>';

                }

            }else{

                $data[] = "<li class='text-danger'>No result found</li>";
            }

            echo json_encode($data);

        }
        die();
    }

    function search_results(){

        $home = new Home();

        if($_POST['ajax'] == true){

            $str = $this->post('search');
            $get = $home->search('title', $str);

            $data = [];

            if(count($get) > 0){


                foreach ($get as $value){

                    $data[] ='<tr><a href="'.$value->id.'">'. $value->title.'</a> </tr>';

                }

            }else{

                $data[] = "<li class='text-danger'>No result found</li>";
            }

            echo json_encode($data);

        }
        die();
    }
}
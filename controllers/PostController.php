<?php


class PostController extends Controller
{
    function index(){

        $post = new Post();
        $posts = $post->findAll();
        //dd($posts);

        $this->render('posts.index',[
            'posts' => $posts,
        ]);
    }

    function read($id = null, $slug = null){

        $post = new Post();

        if($slug == null || $id == null){

            $posts = $post->findAll();
            $this->render('home.welcome',[
                'posts' => $posts,
            ]);
        }

        $posts = $post->find(['id', '=', $id]);

        /*if(!isset($posts)){
            $this->e404("Product  not found");
        }*/

        if($slug !== $posts->slug){

            //dd($posts->slug);die();
            $this->redirect('post/read', ['id' => $id, 'slug' => $posts->slug], 301);
        }

        $this->render('posts.show',[
            'post' => $posts,
        ]);
    }

    function create(){
        $this->render('posts.create');
    }

    function store(){

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $err = [];
            $name = $this->text('name');

            if ($this->success() === true) {

                $err["success"] = $name;
            } else {

                $err["error"] = $this->error('name');
            }

            echo json_encode($err);
            die();
        }
        //$this->render('posts.create');
    }
}
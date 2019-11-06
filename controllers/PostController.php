<?php


class PostController extends Controller
{
    function index(){

        $post = new Post();
        $posts = $post->findAll();
        //dd($posts);

        $this->view('posts.index',[
            'posts' => $posts,
        ]);
    }

    function read($id = null, $slug = null){

        $post = new Post();

        if($slug == null || $id == null){

            $posts = $post->findAll();
            $this->view('home.welcome',[
                'posts' => $posts,
            ]);
        }

        $posts = $post->find(['id', '=', $id]);

        if(!isset($posts)){
            $this->e404("Product  not found");
        }

        if($slug !== $posts->slug){

            //dd($posts->slug);
            $this->redirect('post/read', ['id' => $id, 'slug' => $posts->slug], 301);
        }

        $this->view('posts.show',[
            'post' => $posts,
        ]);
    }

    function create(){
        $this->view('posts.create');
    }

    function store(){

        if($_POST['ajax'] == true || isset($_POST['submit'])) {

            $err = [];
            $name = $this->text('name');

            if ($this->success() === true) {

                $this->flash['message'] = 'Success';
            } else {

                $this->flash["message"] = $this->error('name');
            }

            if ($_POST['ajax'] === 'true'){

                echo json_encode($this->flash);
                die();

            }else{
                return $this->view('posts.create');
            }

        }
        $this->view('posts.create');
    }
}
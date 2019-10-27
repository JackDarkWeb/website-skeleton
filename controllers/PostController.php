<?php


class PostController extends Controller
{
    function index(){

        $post = new Post();
        $posts = $post->findAll();

        $this->render('posts.index',[
            'posts' => $posts,
        ]);
    }

    function read($id = null){

        //var_dump($id);

        if($id === null){

            $post = new Post();
            $posts = $post->findAll();

            $this->render('posts.index',[
                'posts' => $posts,
            ]);

        }else{

            $post = new Post();
            $postId = $post->find(['id', '=', $id]);

            if(!isset($postId)){
                $this->e404("Product $id not found");
            }

            $this->render('posts.show',[
                'post' => $postId,
            ]);
        }
    }
}
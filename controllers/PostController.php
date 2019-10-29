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

    function read($slug = null){

        //var_dump($id);

        if($slug === null){

            $post = new Post();
            $posts = $post->findAll();

            $this->render('posts.index',[
                'posts' => $posts,
            ]);

        }else{

            $post = new Post();

            //dd($slug);
            $postId = $post->find(['slug', '=', $slug]);


            /*if(!isset($postId)){
                $this->e404("Product  not found");
            }*/

            $this->render('posts.show',[
                'post' => $postId,
            ]);
        }
    }
}
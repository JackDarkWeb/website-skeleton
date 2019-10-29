<h1>Tous les products</h1>

<? foreach ($posts as $post):?>
    <ul>
        <li><h3><a href="<?=Router::url("post/read/id:{$post->id}/slug:{$post->slug}")?>"><?=$post->name?></a></h3> </li>
        <li><p> <?=$post->content?></p></li>
    </ul>

<?endforeach;?>


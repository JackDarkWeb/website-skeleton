<h1>Tous les products</h1>

<? foreach ($posts as $post):?>
    <ul>
        <li><h3><a href="/pages/show/<?=$post->slug?>"><?=$post->name?></a></h3> </li>
        <li><p> <?=$post->content?></p></li>
    </ul>

<?endforeach;?>


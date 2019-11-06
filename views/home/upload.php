
<h3>Upload the multiple files</h3>

<form method="post" action="" enctype="multipart/form-data">

    <input type="file" name="file[]"/>
    <input type="file" name="file[]"/>
    <input type="file" name="file[]"/>

    <button type="submit">Uploaded</button><br/>
    <?=$this->error('file')?>
    <?for($i = 0; $i <= 2; $i++)
        echo $this->error('file'.$i).'<br/>';
    ?>



</form>

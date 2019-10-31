

<form method="post" action="/post/store" id="form-test">
    <input type="text" name="name" id="name"/>
    <?  echo $this->error('name');?>
    <button type="submit">Send</button>
</form>
<div id="result"></div>
<script>
    $(function () {

        /*let txt = '{"name":"John", "age":30, "city":"New York"}';
        let obj = JSON.parse(txt);
        alert(obj);*/

        $(document).on('submit', '#form-test', function (e) {
            e.preventDefault();

            let name = encodeURIComponent($('#name').val());
           /* let json = {"name":name};
            let jsonString = JSON.stringify(json);
            let jsonParsed = JSON.parse(jsonString);*/

            $.ajax({
                url: '/post/store',
                type: 'POST',
                dataType: 'json',
                async: true,
                cache: false,
                data: {name:name},
                success:function (response, status, xhr) {

                    if(response.success){
                        $('#result').html(response.success);
                    }else if(response.error){
                        $('#result').html(response.error);
                    }

                },
                error: function (resp, status, error) {
                    $('#result').html(error);
                    //console.log(resp);
                },
                //complete: function(xhr){ console.log(xhr.getAllResponseHeaders())}
            });
        });

    })
</script>

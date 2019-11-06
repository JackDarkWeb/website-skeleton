$(function(){

    $('#search').on('keyup', function () {

        let search = $(this).val();
        const ajax = true;

        $.ajax({
            url: '/home/search',
            dataType:'json',
            type: 'POST',
            async: true,
            cache: false,
            data: {search:search, ajax:ajax},
            success: function (response) {

                if(response !== ''){

                    $('#search-section').find('ul').html(response).show();
                    //$('.data').hide();

                    $('#search-section').find('a').on({

                        mouseenter: function(){
                            $(this).css({
                                backgroundColor: 'rgba(220,220,220, 0.6)',
                                cursor: 'pointer',
                                width: '226px'
                            });
                        },
                        mouseleave: function () {
                            $(this).css('background-color', 'white')
                        },
                        click: function (event) {

                            event.preventDefault();

                            $('#search').val($(this).text()).focus();
                            id = $(this).attr('href');
                            $('#search-section').find('ul').html(response).hide();



                            $.ajax({
                                url: '/home/search_results',
                                type: 'POST',
                                async: true,
                                dataType:'json',
                                cache: false,
                                data: {id:id, ajax:ajax},
                                success: function (response) {
                                    //alert(data);
                                    if(response !== ''){

                                        $('.table').show();
                                        $('tbody').find('tr').html(response);

                                    }else{

                                        $('#search-section').find('.not-found').html('Aucune information sur ' + search);

                                    }
                                }
                            });
                        }
                    });

                }else{

                    $('.result').add('.data').hide();
                }
            },
            error: function (resp, status, error) {
                $('.result').html(error);
                //console.log(resp);
            },
        });

    });
});
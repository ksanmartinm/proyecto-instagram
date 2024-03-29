var url = 'http://proyecto.com'
window.addEventListener("load", function() {
    $('.btn-like, .btn-dislike').css('cursor', 'pointer');

    // Boton de like
    function like(){
        $('.btn-like').off('click').on('click', function() {
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/img/hearts-red.png');

            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if (response.like) {
                        console.log('Has dado like a la publicacion');
                    }else{
                        console.log('Error al dar like');
                    }
                }
            });

            dislike();
        });
    }
    like();

    // Boton de dislike
    function dislike(){
        $('.btn-dislike').off('click').on('click', function() {
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/img/hearts-black.png');

            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if (response.like) {
                        console.log('Has dado dislike a la publicacion');
                    }else{
                        console.log('Error al dar dislike');
                    }
                }
            });

            like();
        });
    }
    dislike();

    // BUSCADOR
    $('#buscador').submit(function(e){
        $(this).attr('action',url+'/gente/'+$('#buscador #search').val());
    });
});

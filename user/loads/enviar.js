$(document).ready(function(){

    $('#submit').click(function(){
        var titulo = $('#titulo').val();
        var subtitulo = $('#subtitulo').val();

        $('#alert').html('');
        $('#alert').removeClass("alert alert-danger");
        $('#titulo').removeClass("is-invalid");
        $('#subtitulo').removeClass("is-invalid");
        $('#arquivo').removeClass("is-invalid");

        if (titulo == "") {
            $('#titulo').addClass("is-invalid");
            return false;
        }

        if (subtitulo == "") {
            $('#subtitulo').addClass("is-invalid");
            return false;
        }

        if($('#arquivo')[0].files.length == 0 ){
            $('#arquivo').addClass("is-invalid");
            return false;
        }

        var arquivo = $('#arquivo')[0].files[0];
        var extensao = arquivo.name.substr(-4, 4).toLowerCase();

        if (extensao !== ".pdf") {
            $('#arquivo').addClass("is-invalid");
            return false;
        }

        var fd = new FormData();

        fd.append('titulo', titulo);
        fd.append('subtitulo', subtitulo);
        fd.append('arquivo', arquivo);
        fd.append('extensao', extensao);

        $.ajax({
            url: 'actions/enviar.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function() {window.location.href = "meus_posts.php";}
        });

    });
});
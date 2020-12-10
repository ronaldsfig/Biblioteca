$(document).ready(function(){

    $('#submit').click(function(){
        var nome = $('#nome').val();
        var email = $('#email').val();
        var senha = $('#senha').val();
        var confirma_senha = $('#confirma_senha').val();
        var nascimento = $('#nascimento').val();
        var perm = $('input[name="perm"]:checked').val();

        $('#alert').html('');
        $('#alert').removeClass("alert alert-danger");
        $('#nome').removeClass("is-invalid");
        $('#email').removeClass("is-invalid");
        $('#senha').removeClass("is-invalid");
        $('#confirma_senha').removeClass("is-invalid");
        $('#nascimento').removeClass("is-invalid");

        if (nome == '') {
            $('#nome').addClass("is-invalid");
            return false;			
        }

        var usuario = email.substring(0, email.indexOf("@"));
        var dominio = email.substring(email.indexOf("@")+ 1, email.length);

        if ((usuario.length >=1) &&
            (dominio.length >=3) &&
            (usuario.search("@")==-1) &&
            (dominio.search("@")==-1) &&
            (usuario.search(" ")==-1) &&
            (dominio.search(" ")==-1) &&
            (dominio.search(".")!=-1) &&
            (dominio.indexOf(".") >=1)&&
            (dominio.lastIndexOf(".") < dominio.length - 1)) {
        }else{
            $('#email').addClass("is-invalid");
            return false;
        }

        if (senha == '') {
            $('#senha').addClass("is-invalid");
            return false;					
        }

        if (confirma_senha !== senha) {
            $('#confirma_senha').addClass("is-invalid");
            return false;				
        }

        if (nascimento == '') {
            $('#nascimento').addClass("is-invalid");
            return false;			
        }

        $.ajax({
            url: 'actions/vrf_email.php',
            type: 'POST',
            data: {email : email},
            dataType: 'json',
            success: function(retorno) {
              if (retorno === false) {
                $('#alert').html('E-mail já existente.');
                $('#alert').addClass("alert alert-danger");	
              }else{
                $.ajax({
                    url:'actions/add_usuario.php',
                    method: 'POST',
                    data: {nome: nome, email:email, senha:senha, nascimento:nascimento, perm:perm},
                    success: function() {window.location.href = "index.php";}
                });
              }
        
            },
          });

    });
});
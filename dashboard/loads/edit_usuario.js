$(document).ready(function(){

    var emailNative = $('#email').val();

    $('#submit').click(function(){
        var id = $('#id').val();
        var nome = $('#nome').val();
        var email = $('#email').val();
        var senha = $('#senha').val();
        var confirma_senha = $('#confirma_senha').val();
        var nascimento = $('#nascimento').val();
        var perm = $('#perm').val();
        var condicao = $('#condicao').val();

        var result;

        $('#alert').html('');
        $('#alert').removeClass("alert alert-danger");
        $('#nome').removeClass("is-invalid");
        $('#email').removeClass("is-invalid");
        $('#nascimento').removeClass("is-invalid");
        $('#confirma_senha').removeClass("is-invalid");

        if (nome == '') {
            $('#nome').addClass("is-invalid");
            return false;				
        }

        if (email == '') {
            $('#email').addClass("is-invalid");
            return false;					
        }

        if (email !== emailNative) {
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
                $.ajax({
                    url: 'actions/vrf_email.php',
                    type: 'POST',
                    async: false,
                    data: {email : email},
                    dataType: 'json',
                    success: function(resultEmail) {result = resultEmail;}
                    }
                );
                if (result === false) {
                    $('#alert').html('E-mail já existente.');
                    $('#alert').addClass("alert alert-danger");
                    return false;
                };
            }
            else{
                $('#email').addClass("is-invalid");
                return false;
            }
        }

        if (nascimento == '') {
            $('#nascimento').addClass("is-invalid");
            return false;				
        }

        if (senha !== "" || confirma_senha !== "") {
            if (senha == confirma_senha) {
                $.ajax({
                    url:'actions/edit_senha.php',
                    method: 'POST',
                    data: {id: id, senha: senha},
                    success: function(resultSenha) {result = resultSenha;}
                });
                if (result === false) {
                    $('#alert').html('Erro ao editar a senha.');
                    $('#alert').addClass("alert alert-danger");
                    return false;
                }
            }else{
                $('#confirma_senha').addClass("is-invalid");
                return false;
            }				
        }

        $.ajax({
            url:'actions/edit_usuario.php',
            method: 'POST',
            data: {id: id, nome: nome, email: email, nascimento: nascimento, perm: perm, condicao: condicao},
            success: function() {window.location.href = "index.php";}
        });


    });
});
$(document).ready(function(){
    $('#adicionar').click(function(){
        var nome = $('#nome').val();
        var email = $('#email').val();
        var senha = $('#senha').val();
        var confirma_senha = $('#confirma_senha').val();
        var nascimento = $('#nascimento').val();
        var perm = $('input[name="perm"]:checked').val();

        $('#result').html('');
        if (nome == '') {
            $('#alert').html('Preencha o nome.');
            $('#alert').addClass("alert alert-danger");
            return false;				
        }

        $('#result').html('');
        if (email == '') {
            $('#alert').html('Preencha o e-mail.');
            $('#alert').addClass("alert alert-danger");
            return false;				
        }

        $('#result').html('');
        if (senha == '') {
            $('#alert').html('Preencha a senha.');
            $('#alert').addClass("alert alert-danger");
            return false;				
        }

        $('#result').html('');
        if (confirma_senha !== senha) {
            $('#alert').html('Confirme corretamente a senha.');
            $('#alert').addClass("alert alert-danger");
            return false;				
        }

        $('#result').html('');
        if (nascimento == '') {
            $('#alert').html('Informe uma data de nascimento.');
            $('#alert').addClass("alert alert-danger");
            return false;				
        }

        $('#result').html('');

        $.ajax({
            url: 'loads/verificar_email.php',
            type: 'POST',
            data: {email : email},
            dataType: 'json',
            success: function(retorno) {
              if (retorno === false) {
                $('#alert').html('E-mail já existente.');
                $('#alert').addClass("alert alert-danger");	
              }else{
                $.ajax({
                    url:'loads/adicionar_usuario.php',
                    method: 'POST',
                    data: {nome: nome, email:email, senha:senha, confirma_senha: confirma_senha, nascimento:nascimento, perm:perm},
                    success: function(result) {
                        $('form').trigger("reset");
                        $('#alert').removeClass("alert alert-danger");
                        $('#alert').addClass("alert alert-success");
                        $('#alert').fadeIn().html("Usuário adicionado com sucesso!");
                        setTimeout(function(){
                            $('#alert').fadeOut('Slow');
                        },3000);
                    }
                });
              }
        
            },
          });

    });
});
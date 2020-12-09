$(function(){

    var verify = "verified";

    $.ajax({
        url: 'actions/usuarios.php',
        type: 'POST',
        data: {verify : verify},
        dataType: 'html',
        success: function(retorno) {
            $("#conteudo").html(retorno);
            $('#tabela').DataTable( {
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Não há registros disponíveis",
                    "infoFiltered": "(Filtrado de _MAX_ registros no total)",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    }
                }
            } );
        },
      });
        
});
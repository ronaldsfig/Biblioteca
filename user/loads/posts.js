$(function(){
    $("#pesquisa").keyup(function(){
        var pesquisa = $(this).val();

        var dados = {
            palavra : pesquisa
        }
        $.post('loads/posts.php', dados, function(retorna){
            $("#conteudo").html(retorna);
        });
        
    });
});
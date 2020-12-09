$(function(){
    var pesquisa = "";

    var dados = {
        palavra : pesquisa
    }

    $.post('actions/meus_posts.php', dados, function(retorna){
        $("#conteudo").html(retorna);
    });
        
    
    $("#pesquisa").keyup(function(){
        var pesquisa = $(this).val();

        var dados = {
            palavra : pesquisa
        }
        $.post('actions/meus_posts.php', dados, function(retorna){
            $("#conteudo").html(retorna);
        });
        
    });
});
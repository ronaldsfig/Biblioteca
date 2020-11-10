<?php
class USER extends CONNECT{

    private $perm;

    function __construct($perm){
        $this->perm = $perm;
    }

    public function newPost($autor, $titulo, $subtitulo, $conteudo){
        $sql = "INSERT INTO publicacoes (id_usuario, titulo, subtitulo, conteudo, data_postagem) VALUES ('{$autor}', '{$titulo}', '{$subtitulo}', '{$conteudo}', NOW())";
        if ($this->connection()->query($sql)) {
            return true;
        }else {
            return 'Não foi possível publicar!';
        };
    }

}
?>
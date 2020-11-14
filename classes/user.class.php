<?php
class USER extends CONNECT{

    private $perm;

    function __construct($perm){
        $this->perm = $perm;
    }

    public function newPost($idUsuario, $titulo, $subtitulo, $nome){
        $sql = "INSERT INTO posts (id_autor, titulo, subtitulo, nome_arquivo, data_postagem, perm) VALUES ('$idUsuario', '$titulo', '$subtitulo', '$nome', NOW(), '$this->perm');";

        if ($this->connection()->query($sql) === TRUE) {
            return true;
        }else {
            return 'Erro ao enviar enviar arquivo!';
        }
    }


}
?>
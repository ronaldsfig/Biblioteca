<?php
class USER extends CONNECT{

    private $perm;

    function __construct($perm){
        $this->perm = $perm;
    }

    public function getPerm(){
        switch ($this->perm) {
            case 2:
                return 'Nível 1';
                break;

            case 3:
                return 'Nível 2';
                break;

            case 4:
                return 'Nível 3';
                break;
            
            default:
                return 'Permissão desconhecida';
                break;
        }
    }

    public function newPost($idUsuario, $titulo, $subtitulo, $nome){
        $sql = "INSERT INTO posts (id_autor, titulo, subtitulo, nome_arquivo, data_postagem, perm) VALUES ('$idUsuario', '$titulo', '$subtitulo', '$nome', NOW(), '$this->perm');";

        if ($this->connection()->query($sql) === TRUE) {
            return true;
        }else {
            return false;
        }
    }

    public function getUserPosts($idUsuario, $search){
        $sql = "SELECT p.id, u.id, u.nome, p.titulo, p.subtitulo, p.nome_arquivo, p.data_postagem, e.nome_perm FROM posts p JOIN usuarios u JOIN perm e ON p.id_autor = u.id AND p.perm = e.id WHERE (u.id = '$idUsuario') AND (u.nome LIKE '%$search%' OR (p.titulo LIKE '%$search%' OR (p.subtitulo LIKE '%$search%' OR (e.nome_perm LIKE '%$search%')))) ORDER BY p.data_postagem DESC LIMIT 21;";

        $result = $this->connection()->query($sql);
        $numRows = $result->num_rows;

        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            };
        }else {
            return false;
        }

        return $data;
    }

    public function getPosts($search){
        switch ($this->perm) {
            case 2:
                $sql = "SELECT p.id, u.nome, p.titulo, p.subtitulo, p.nome_arquivo, p.data_postagem, e.nome_perm FROM posts p JOIN usuarios u JOIN perm e ON p.id_autor = u.id AND p.perm = e.id WHERE (p.perm = '2') AND (u.nome LIKE '%$search%' OR (p.titulo LIKE '%$search%' OR (p.subtitulo LIKE '%$search%' OR (e.nome_perm LIKE '%$search%')))) ORDER BY p.data_postagem DESC LIMIT 21;";
                break;

            case 3:
                $sql = "SELECT p.id, u.nome, p.titulo, p.subtitulo, p.nome_arquivo, p.data_postagem, e.nome_perm FROM posts p JOIN usuarios u JOIN perm e ON p.id_autor = u.id AND p.perm = e.id WHERE (p.perm = '2' OR p.perm = '3') AND (u.nome LIKE '%$search%' OR (p.titulo LIKE '%$search%' OR (p.subtitulo LIKE '%$search%' OR (e.nome_perm LIKE '%$search%')))) ORDER BY p.data_postagem DESC LIMIT 21;";
                break;
                
            case 4:
                $sql = "SELECT p.id, u.nome, p.titulo, p.subtitulo, p.nome_arquivo, p.data_postagem, e.nome_perm FROM posts p JOIN usuarios u JOIN perm e ON p.id_autor = u.id AND p.perm = e.id WHERE (u.nome LIKE '%$search%' OR (p.titulo LIKE '%$search%' OR (p.subtitulo LIKE '%$search%' OR (e.nome_perm LIKE '%$search%')))) ORDER BY p.data_postagem DESC LIMIT 21;";
                break;
        };

        $result = $this->connection()->query($sql);
        $numRows = $result->num_rows;

        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            };
        }else {
            return false;
        }

        return $data;
    }

    


}
?>
<?php
class ADMIN extends CONNECT{

    public function getAllUsers(){
        $sql = "SELECT * FROM usuarios;";
        $result = $this->connection()->query($sql);
        $numRows = $result->num_rows;

        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            };
        }

        return $data;
    }

    public function verifyEmail($emailUsuario){
        $sql = "SELECT * FROM usuarios WHERE email = '$emailUsuario';";
        $result = $this->connection()->query($sql);

        if ($result->num_rows == 1) {
            return false;
        }else {
            return true;
        }
    }

    public function insertNewUser($nomeUsuario, $emailUsuario, $senhaUsuario, $nascimentoUsuario, $permUsuario){

        $sqlInsert = "INSERT INTO usuarios (nome, email, senha, data_nascimento, perm, condicao) VALUES ('$nomeUsuario','$emailUsuario',MD5('$senhaUsuario'),'$nascimentoUsuario','$permUsuario', 'enable');";

        if ($this->connection()->query($sqlInsert) === TRUE) {
            return true;
        }else {
            return 'Erro ao cadastrar!';
        }
    }

    public function getUserDatas($id){

        $sql = "SELECT * FROM usuarios WHERE id = '$id';";
        $result = $this->connection()->query($sql);
        $numRows = $result->num_rows;

        if ($numRows > 0) {
            $datas = $result->fetch_assoc();
        };

        return $datas;


    }

    public function updateUserDatas($idUsuario, $nomeUsuario, $emailUsuario, $nascimentoUsuario, $permUsuario, $condUsuario){
        
        if ($nomeUsuario == "") {
            return 'Informe o novo nome do usuário!';
        };

        if ($emailUsuario == "") {
            return 'Informe o novo e-mail usuário!';
        };

        if ($nascimentoUsuario == "") {
            return 'Informe uma data de nascimento!';
        };

        $sql = "UPDATE usuarios SET nome = '$nomeUsuario', email = '$emailUsuario', data_nascimento = '$nascimentoUsuario', perm = '$permUsuario', condicao = '$condUsuario' WHERE id = '$idUsuario';";

        if ($this->connection()->query($sql) === TRUE) {
            return true;
        }else {
            return 'Erro ao editar!';
        }
    }

    public function updateUserPassword($idUsuario, $senhaUsuario){

        $sql = "UPDATE usuarios SET senha = MD5('$senhaUsuario') WHERE id = '$idUsuario';";

        if ($this->connection()->query($sql) === TRUE) {
            return true;
        }else {
            return false;
        }

    }

    public function getAllPosts(){

        $sql = "SELECT p.id, u.nome, p.titulo, p.subtitulo, p.nome_arquivo, p.data_postagem, e.nome_perm FROM posts p JOIN usuarios u JOIN perm e ON p.id_autor = u.id AND p.perm = e.id;";

        $result = $this->connection()->query($sql);
        $numRows = $result->num_rows;

        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            };
        }

        return $data;
    }

    public function shelvePost($nomeArquivo){

        $sql = "DELETE FROM posts WHERE nome_arquivo = '$nomeArquivo';";

        $origem = '../../posts/'.$nomeArquivo;
        $destino = '../../posts/trash/'.$nomeArquivo;
        copy($origem, $destino);
        unlink($origem);

        if ($this->connection()->query($sql) === TRUE) {
            return true;
        }else {
            return false;
        }

    }

}
?>
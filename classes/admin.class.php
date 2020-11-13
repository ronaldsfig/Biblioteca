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

    public function insertNewUser($nomeUsuario, $emailUsuario, $senhaUsuario, $nascimentoUsuario, $permUsuario){

        if ($nomeUsuario == "") {
            return 'Informe o nome do novo usuário!';
        };

        if ($emailUsuario == "") {
            return 'Informe o e-mail do novo usuário!';
        };

        if ($senhaUsuario == "") {
            return 'Informe a senha do novo usuário!';
        };

        if ($nascimentoUsuario == "") {
            return 'Informe uma data de nascimento!';
        };

        $sql = "SELECT * FROM usuarios WHERE email = '$emailUsuario';";
        $result = $this->connection()->query($sql);

        if ($result->num_rows == 1) {
            return 'Email já existente!';
        };

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

        $sql = "UPDATE usuarios SET senha = '$senhaUsuario' WHERE id = '$idUsuario';";

        if ($this->connection()->query($sql) === TRUE) {
            return true;
        }else {
            return false;
        }

    }

}
?>
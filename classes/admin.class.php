<?php
class ADMIN extends CONNECT{

    public function getAllUsers(){
        $sql = "SELECT * FROM usuarios";
        $result = $this->connection()->query($sql);
        $numRows = $result->num_rows;

        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            };
        }

        return $data;
    }

    public function insertNewUser($nomeUsuario, $emailUsuario, $senhaUsuario, $confirmaSenhaUsuario, $nascimentoUsuario, $permUsuario){

        if ($senhaUsuario !== $confirmaSenhaUsuario) {
            return 'Informe corretamente as senhas!';
            exit;
        };

        $sqlEmail = "SELECT * FROM usuarios WHERE email = '$emailUsuario'";
        $resultEmail = $this->connection()->query($sqlEmail);
        $sqlPassword = "SELECT * FROM usuarios WHERE senha = '$senhaUsuario'";
        $resultPassword = $this->connection()->query($sqlPassword);

        if ($resultEmail->num_rows == 1 || $resultPassword->num_rows == 1) {
            return 'Email ou senha já existentes!';
            exit;
        };

        if ($nascimentoUsuario == "") {
            return 'Informe uma data de nascimento!';
            exit;
        }

        $sqlInsert = "INSERT INTO usuarios (nome, email, senha, data_nascimento, perm) VALUES ('{$nomeUsuario}','{$emailUsuario}',MD5('{$senhaUsuario}'),'{$nascimentoUsuario}','{$permUsuario}')";
        if ($this->connection()->query($sqlInsert) === TRUE) {
            return true;
        }else {
            return 'Erro ao cadastrar!';
        }
    }

}
?>
<?php
class ADMIN extends CONNECT{

    private $insertedUser = array();

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

    public function verifyInsertDatas($nomeUsuario, $emailUsuario, $senhaUsuario, $confirmaSenhaUsuario, $nascimentoUsuario, $permUsuario){

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

        $this->insertedUser["nome"] = $nomeUsuario;
        $this->insertedUser["email"] = $emailUsuario;
        $this->insertedUser["senha"] = $senhaUsuario;
        $this->insertedUser["data_nascimento"] = $nascimentoUsuario;
        $this->insertedUser["perm"] = $permUsuario;

        return true;
    }

    public function insertNewUser(){
        $sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento, perm) VALUES ('{$this->insertedUser['nome']}', '{$this->insertedUser['email']}', MD5('{$this->insertedUser['senha']}'), '{$this->insertedUser['data_nascimento']}', '{$this->insertedUser['perm']}')";
        if ($this->connection()->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

}
?>
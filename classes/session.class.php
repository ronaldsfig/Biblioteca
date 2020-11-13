<?php
session_start();
class SESSION extends CONNECT{

    private $loginEmail;
    private $loginPassword;

    public function login($email, $password){
        $this->loginEmail = mysqli_real_escape_string($this->connection(), $email);
        $this->loginPassword = mysqli_real_escape_string($this->connection(), $password);

        //$sql = "SELECT * FROM usuarios WHERE email = '{$this->loginEmail}' AND senha = MD5('{$this->loginPassword}')";
        $sql = "SELECT * FROM usuarios WHERE email = '{$this->loginEmail}' AND senha = '{$this->loginPassword}'";
        $result = $this->connection()->query($sql);

        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();

            if ($data['condicao'] == 'disable') {
                $_SESSION['nao_autenticado'] = true;
                header('Location: index.php');
                exit();
            };

            switch ($data['perm']) {
                case 1:
                    $_SESSION['user'] = $data;
                    header('Location: dashboard/index.php');
                    exit();
                    break;

                default:
                    $_SESSION['user'] = $data;
                    header('Location: user/index.php');
                    exit();
                    break;
                    
            }
        }else {
            $_SESSION['nao_autenticado'] = true;
            header('Location: index.php');
            exit();
        }

    }

}
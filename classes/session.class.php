<?php
session_start();
class SESSION extends CONNECT{

    private $loginEmail;
    private $loginPassword;

    public function login($email, $password){
        $this->loginEmail = mysqli_real_escape_string($this->connection(), $email);
        $this->loginPassword = mysqli_real_escape_string($this->connection(), $password);

        $sql = "SELECT * FROM usuarios WHERE email = '{$this->loginEmail}' AND senha = '{$this->loginPassword}'";
        $result = $this->connection()->query($sql);

        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            switch ($data['perm']) {
                case 0:
                    $_SESSION['user'] = $data;
                    header('Location: dashboard/index.php');
                    exit();
                    break;

                case 1:
                    $_SESSION['user'] = $data;
                    header('Location: user/index.php');
                    exit();
                    break;

                case 2:
                    echo "nivel 2";
                    exit();
                    break;

                case 3:
                    echo "nivel 3";
                    exit();
                    break;
                
                default:
                    # code...
                    exit();
                    break;
            }
        }else {
            $_SESSION['nao_autenticado'] = true;
            header('Location: index.php');
        }

    }

}
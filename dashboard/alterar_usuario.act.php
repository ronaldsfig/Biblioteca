<?php
session_start();
include "session/verify.php";
include "../classes/connect.class.php";
include "../classes/admin.class.php";

$idUsuario = $_POST['id'];
$nomeUsuario = $_POST['nome'];
$emailUsuario = $_POST['email'];
$senhaUsuario = $_POST['senha'];
$confirmaSenhaUsuario = $_POST['confirma_senha'];
$nascimentoUsuario = $_POST['nascimento'];
$permUsuario = $_POST['perm'];
$condUsuario = $_POST['cond'];

    if ($senhaUsuario !== "" || $confirmaSenhaUsuario !== "") {
        if ($senhaUsuario == $confirmaSenhaUsuario) {
            $nova_senha = new ADMIN();
                $result_senha = $nova_senha->updateUserPassword($idUsuario, $senhaUsuario);
                if ($result_senha === FALSE) {
                    $_SESSION['erro'] = 'Não foi possível alterar a senha!';
                    header('Location: index.php');
                    exit();
                };
            $nova_senha->close();
        }else{
            $_SESSION['erro'] = 'As senhas não conferem!';
            header('Location: index.php');
            exit();
        }
    };

    $editar = new ADMIN();
        $result = $editar->updateUserDatas($idUsuario, $nomeUsuario, $emailUsuario, $nascimentoUsuario, $permUsuario, $condUsuario);
        if ($result === TRUE) {
            $_SESSION['sucesso'] = 'Usuário editado com sucesso!';
            header('Location: index.php');
            exit();
        }else {
            $_SESSION['erro'] = $result;
            header('Location: index.php');
            exit();
        };
    $editar->close();


?>
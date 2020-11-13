<?php
session_start();
include "session/verify.php";
include "../classes/connect.class.php";
include "../classes/admin.class.php";

$nomeUsuario = $_POST['nome'];
$emailUsuario = $_POST['email'];
$senhaUsuario = $_POST['senha'];
$confirmaSenhaUsuario = $_POST['confirma_senha'];
$nascimentoUsuario = $_POST['nascimento'];
$permUsuario = $_POST['perm'];

    if ($senhaUsuario !== $confirmaSenhaUsuario) {
        $_SESSION['erro'] = 'As senhas não conferem!';
        header('Location: index.php');
        exit();
    };

    $inserir = new ADMIN();
        $result = $inserir->insertNewUser($nomeUsuario, $emailUsuario, $senhaUsuario, $nascimentoUsuario, $permUsuario);
        if ($result === TRUE) {
            $_SESSION['sucesso'] = 'Usuário adicionado com sucesso!';
            header('Location: index.php');
            exit();
        }else {
            $_SESSION['erro'] = $result;
            header('Location: index.php');
            exit();
        };
    $inserir->close();

?>
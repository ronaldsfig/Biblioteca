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

    $inserir = new ADMIN();
        $result = $inserir->insertNewUser($nomeUsuario, $emailUsuario, $senhaUsuario, $confirmaSenhaUsuario, $nascimentoUsuario, $permUsuario);
        if ($result === TRUE) {
            $_SESSION['usuario_adicionado'] = true;
            header('Location: index.php');
            exit();
        }else {
            $_SESSION['usuario_nao_adicionado'] = $result;
            header('Location: index.php');
            exit();
        };
    $inserir->close();

?>
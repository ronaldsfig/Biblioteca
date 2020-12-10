<?php
session_start();
include "../session/verify.php";
include "../../classes/connect.class.php";
include "../../classes/admin.class.php";

if($_POST['id'] === NULL){
    header("Location: ../index.php");
    exit;
};

$idUsuario = $_POST['id'];
$nomeUsuario = $_POST['nome'];
$emailUsuario = $_POST['email'];
$senhaUsuario = $_POST['senha'];
$nascimentoUsuario = $_POST['nascimento'];
$permUsuario = $_POST['perm'];
$condUsuario = $_POST['condicao'];

    $editar = new ADMIN();
        $result = $editar->updateUserDatas($idUsuario, $nomeUsuario, $emailUsuario, $nascimentoUsuario, $permUsuario, $condUsuario);
        if ($result === TRUE) {
            $_SESSION['sucesso'] = 'Usuário editado com sucesso!';
        }else {
            $_SESSION['erro'] = 'Erro ao editar usuário.';
        };
    $editar->close();

?>
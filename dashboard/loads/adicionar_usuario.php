<?php
session_start();
include "../session/verify.php";
include "../../classes/connect.class.php";
include "../../classes/admin.class.php";

if($_POST['nome'] === NULL){
    header("Location: ../index.php");
    exit;
};

$nomeUsuario = $_POST['nome'];
$emailUsuario = $_POST['email'];
$senhaUsuario = $_POST['senha'];
$nascimentoUsuario = $_POST['nascimento'];
$permUsuario = $_POST['perm'];

    $inserir = new ADMIN();
        $result = $inserir->insertNewUser($nomeUsuario, $emailUsuario, $senhaUsuario, $nascimentoUsuario, $permUsuario);
    $inserir->close();

?>
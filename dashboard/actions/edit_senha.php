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
    $senhaUsuario = $_POST['senha'];

    $result = true;

    $nova_senha = new ADMIN();
        $result_senha = $nova_senha->updateUserPassword($idUsuario, $senhaUsuario);
        if ($result_senha === FALSE) {
            $result = false;
        };
    $nova_senha->close();

    die(json_encode($result));

?>
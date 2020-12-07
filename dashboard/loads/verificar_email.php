<?php
    session_start();
    include "../../classes/connect.class.php";
    include "../../classes/admin.class.php";
    include "../session/verify.php";
    
    if($_POST['email'] === NULL){
        header("Location: ../index.php");
        exit;
    };

    $email = new ADMIN();
        $result = $email->verifyEmail($_POST['email']);
    $email->close();

    die(json_encode($result));
?>
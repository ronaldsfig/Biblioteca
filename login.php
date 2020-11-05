<?php
include "classes/connect.class.php"; 
include "classes/session.class.php";

if (empty($_POST['email']) || empty($_POST['password'])) {
    header('Location: index.php');
    exit();
};

$login = new SESSION;
    $result = $login->login($_POST['email'], $_POST['password']);
?>
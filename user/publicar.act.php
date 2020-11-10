<?php
    session_start();
    include "session/verify.php";
    include "../classes/connect.class.php";
    include "../classes/user.class.php";

    $publicar = new USER($_SESSION['user']['perm']);
        $result = $publicar->newPost($_SESSION['user']['id'],$_POST['titulo'],$_POST['subtitulo'], $_POST['conteudo']);
        if ($result === TRUE) {
            $_SESSION['postado'] = true;
            header('Location: index.php');
            exit();
        }else {
            $_SESSION['nao_postado'] = true;
            header('Location: index.php');
            exit();
        };
?>
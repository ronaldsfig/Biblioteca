<?php
session_start();
include "../classes/connect.class.php";
include "../classes/user.class.php";
include "session/verify.php";

$titulo = $_POST['titulo'];
$subtitulo = $_POST['subtitulo'];

if ($titulo == "" || $subtitulo == "") {
    $_SESSION['erro'] = "Defina um título e subtítulo válidos!";
    header('Location: meus_posts.php');
    exit();
};

if (isset($_FILES['arquivo'])) {
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
    if ($extensao !== ".pdf") {
        $_SESSION['erro'] = "Escolha um arquivo no formato PDF!";
        header('Location: meus_posts.php');
        exit();
    }
    $novonome = md5(time()).$extensao;
    $diretorio = "../posts/";

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novonome);

    $postar = new USER($_SESSION['user']['perm']);
        $result = $postar->newPost($_SESSION['user']['id'], $titulo, $subtitulo, $novonome);
        if ($result === TRUE) {
            $_SESSION['sucesso'] = 'Postagem realizada com sucesso';
            header('Location: meus_posts.php');
            exit();
        }else {
            $_SESSION['erro'] = $result;
            header('Location: meus_posts.php');
            exit();
        };
    $postar->close();
};

?>
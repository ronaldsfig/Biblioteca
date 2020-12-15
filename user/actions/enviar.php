<?php
session_start();
include "../../classes/connect.class.php";
include "../../classes/user.class.php";
include "../session/verify.php";

if($_POST['titulo'] === NULL){
    header("Location: ../index.php");
    exit;
};

$titulo = $_POST['titulo'];
$subtitulo = $_POST['subtitulo'];
$extensao = $_POST['extensao'];

    $novonome = md5(time()).$extensao;
    $diretorio = "../../posts/";

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novonome);

    $postar = new USER($_SESSION['user']['perm']);
        $result = $postar->newPost($_SESSION['user']['id'], $titulo, $subtitulo, $novonome);
        if ($result === TRUE) {
            $_SESSION['sucesso'] = 'Arquivo enviado com sucesso!';
        }else {
            $_SESSION['erro'] = "Erro ao enviar arquivo.";
        };
    $postar->close();


?>
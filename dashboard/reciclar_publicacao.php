<?php
session_start();
include "session/verify.php";
include "../classes/connect.class.php";
include "../classes/admin.class.php";

$nomeArquivo = $_GET['nome_arquivo'];

    $reciclar = new ADMIN();
        $result = $reciclar->recyclePost($nomeArquivo);

        if ($result === TRUE) {
            $_SESSION['sucesso'] = 'Arquivo reciclado com sucesso!';
            header('Location: publicacoes.php');
            exit();
        }else {
            $_SESSION['erro'] = 'Erro ao reciclar arquivo!';
            header('Location: publicacoes.php');
            exit();
        }
    $reciclar->close();


?>
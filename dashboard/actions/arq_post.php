<?php
session_start();
include "../session/verify.php";
include "../../classes/connect.class.php";
include "../../classes/admin.class.php";

$nomeArquivo = $_GET['nome_arquivo'];

    $arquivar = new ADMIN();
        $result = $arquivar->shelvePost($nomeArquivo);

        if ($result === TRUE) {
            $_SESSION['sucesso'] = 'Arquivado com sucesso!';
            header('Location: ../publicacoes.php');
            exit();
        }else {
            $_SESSION['erro'] = 'Erro ao arquivar!';
            header('Location: ../publicacoes.php');
            exit();
        }
    $arquivar->close();

?>
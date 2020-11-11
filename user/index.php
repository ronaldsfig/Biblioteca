<?php
session_start();
include "session/verify.php";
include "../classes/connect.class.php";
include "../classes/user.class.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Nelson Mandela</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css">
    <link href="../layout/css/sidebar.css" rel="stylesheet">
    <script type="text/javascript" src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

    <?php
        require_once "../layout/user.php";

        // <>VERIFICA SE HOUVE UMA TENTATIVA DE PUBLICAR

        if (isset($_SESSION['postado'])) {
            echo "<div class='alert alert-success' role='alert'>Publicação realizada com sucesso!</div>";
        }
        unset($_SESSION['postado']);
        
        if (isset($_SESSION['nao_postado'])) {
            echo "<div class='alert alert-danger' role='alert'>Erro ao publicar!</div>";
        }
        unset($_SESSION['nao_postado']);

        // </>VERIFICA SE HOUVE UMA TENTATIVA DE PUBLICAR
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="navbar-brand">Suas publicações</a>
                </li>
                <li class="nav-item">
                    <p>
                        <a class="btn btn-outline-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Adicionar
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <button type="button" class="btn btn-outline-primary">Enviar PDF</button>
                        <a href="criar.php">
                        <button type="button" class="btn btn-outline-secondary">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                        </svg>
                        Criar PDF
                        </button>
                        </a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav>

</body>
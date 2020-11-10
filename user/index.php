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
                    <span class="navbar-brand mb-0 h1">Suas publicações</span>
                </li>
                <li class="nav-item">
                    <p>
                        <a class="btn btn-outline-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Adicionar nova
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <a href="publicar.php"><button type="button" class="btn btn-outline-info">Compor</button></a>
                        <button type="button" class="btn btn-outline-info">Enviar PDF</button>
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
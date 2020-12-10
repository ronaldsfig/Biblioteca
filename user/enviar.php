<?php
session_start();
include "../classes/connect.class.php";
include "../classes/user.class.php";
include "session/verify.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Nelson Mandela</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../layout/css/sidebar.css" type="text/css">
    <script type="text/javascript" src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

    <?php
        require_once "../layout/user.php";
    ?>

    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand">Enviar Arquivo</a>
    </nav>

    <form action="enviar.act.php" method="post" enctype="multipart/form-data">

    <div class="card">
        <div class="card-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="titulospan">Título</span>
                </div>
                <input type="text" class="form-control" name="titulo" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="subtitulospan">Subtítulo</span>
                </div>
                <input type="text" class="form-control" name="subtitulo" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Selecione o arquivo PDF</label>
                <input type="file" name="arquivo" required class="form-control-file" id="arquivo">
            </div>
        </div>
    </div>

    <nav class="navbar navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <span class="navbar-text">
                    - Tamanho máximo suportado: 30MB.
                </span>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <a href="index.php"><button type="button" class="btn btn-outline-secondary">Voltar</button></a>
                <button id="btnCrearPdf" type="submit" class="btn btn-outline-primary">Enviar arquivo</button>
            </li>
        </ul>
    </nav>

    </form>

</body>
</html>
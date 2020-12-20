<?php
session_start();
include "session/verify.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Nelson Mandela</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../layout/css/sidebar.css" type="text/css">
    <script type="text/javascript" src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
    <script src="loads/enviar.js"></script>
</head>

<body>

    <?php
        require_once "../layout/user.php";
    ?>

    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand">Enviar Arquivo</a>
    </nav>

    <form method="post" enctype="multipart/form-data">

    <div class="card">
        <div class="card-body">
        
            <div id="alert" role="alert"></div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="titulospan">Título</span>
                </div>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                <div class="invalid-feedback">Informe um título.</div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="subtitulospan">Subtítulo</span>
                </div>
                <input type="text" class="form-control" name="subtitulo" id="subtitulo" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                <div class="invalid-feedback">Informe um subtítulo.</div>
            </div>
            <div class="form-group">
                <label for="arquivo">Selecione o arquivo PDF</label>
                <input type="file" name="arquivo" required class="form-control" id="arquivo">
                <div class="invalid-feedback">Selecione um arquivo no formato PDF.</div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <span class="navbar-text">
                    - Aguarde após enviar o arquivo, este processo pode demorar minutos.
                </span>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <a href="meus_posts.php"><button type="button" class="btn btn-outline-secondary">Voltar</button></a>
                <button type="button" class="btn btn-outline-primary" id="submit">Enviar arquivo</button>
            </li>
        </ul>
    </nav>

    </form>

</body>
</html>
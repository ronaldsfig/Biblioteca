<?php
session_start();
include "session/verify.php";
include "../classes/connect.class.php";
include "../classes/admin.class.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Nelson Mandela</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../bootstrap/css/datatables-bootstrap4.min.css" type="text/css">
    <link rel="stylesheet" href="../layout/css/sidebar.css">
    <script type="text/javascript" src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/datatables-jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/datatables-bootstrap4.min.js"></script>
    <script src="loads/posts.js"></script>
</head>
<body>

    <?php
        require_once "../layout/dashboard.php"; 

        // <>VERIFICA SE HOUVE UMA TENTATIVA DE %

        if (isset($_SESSION['sucesso'])) {
            echo "<div class='alert alert-success' style='margin-bottom: auto;'>".$_SESSION['sucesso']."</div>";
        }
        unset($_SESSION['sucesso']);
        
        if (isset($_SESSION['erro'])) {
            echo "<div class='alert alert-danger' role='alert' style='margin-bottom: auto;'>".$_SESSION['erro']."</div>";
        }
        unset($_SESSION['erro']);

        // </>VERIFICA SE HOUVE UMA TENTATIVA DE %
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="navbar-brand">Publicações</a>
            </li>
        </ul>
    </nav>

    <div class="card">
    <div class="card-body">
    <table id="tabela" class="table table-responsive-lg table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th>Registro</th>
            <th>Autor</th>
            <th>Título</th>
            <th>Subtítulo</th>
            <th>Nome do Arquivo</th>
            <th>Data de Postagem</th>
            <th>Permissão</th>
            <th>Opções</th>
            </tr>
        </thead>
        <tbody id="conteudo">
            
        </tbody>
    </table>
    </div>
    </div>
    
</body>
</html>
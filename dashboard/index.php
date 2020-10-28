<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Nelson Mandela</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css">
    <link href="../layout/sidebar/css/simple-sidebar.css" rel="stylesheet">
    <script type="text/javascript" src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php require_once "../layout/sidebar/dashboard_sidebar.php"; ?>

<?php 
    include "../includes/connection.inc.php"; 
    include "../includes/menagement.inc.php";
?>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Registro</th>
        <th scope="col">Nome</th>
        <th scope="col">Data de nascimento</th>
        <th scope="col">E-mail</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php 
                
                $usuarios = new admin();
                    $usuarios->viewAllUsers();

            ?>
        </tr>
    </tbody>
    </table>

    

</body>
</html>
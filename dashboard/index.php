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
    include "../includes/connect.class.php"; 
    include "../includes/admin.class.php";
?>

    <table class="table table-striped">
    <thead>
        <th colspan="5" scape="col">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="navbar-brand">Usuários</a>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">Inserir novo</button>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
            </div>
            </nav>
        </th>
    </thead>

    <form method="post">
    <thead>
        <tr>
        <th scope="col">Registro</th>
        <th scope="col">Nome</th>
        <th scope="col">Data de nascimento</th>
        <th scope="col">E-mail</th>
        <th scope="col"><button type="submit" name="alterar" class="btn btn-secondary">Ir para ações</button></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php 
                $usuarios = new ADMIN();
                    $datas = $usuarios->getAllUsers();

                    foreach ($datas as $key) {
                    echo "<th scope='row'>".$key['id']."</th>";
                    echo "<td>".$key['nome']."</td>";
                    echo "<td>".$key['data_nascimento']."</td>";
                    echo "<td>".$key['email']."</td>";
                    echo "<td><input type='checkbox' name='selected[]' value='".$key['id']."'/></td>";

                    }
            ?>
        </tr>
    </tbody>
    </form>
    </table>
    
    <form>
    <div class="modal" tabindex="-1" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>
    </form>

</body>
</html>
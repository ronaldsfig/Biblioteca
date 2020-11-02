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

<?php
    if (isset($_POST['nome'])) {
        $nomeUsuario = $_POST['nome'];
        $emailUsuario = $_POST['email'];
        $senhaUsuario = $_POST['senha'];
        $confirmaSenhaUsuario = $_POST['confirma_senha'];
        $nascimentoUsuario = $_POST['nascimento'];
        $permUsuario = $_POST['perm'];

        $verificar = new ADMIN();
            $result = $verificar->verifyInsertDatas($nomeUsuario, $emailUsuario, $senhaUsuario, $confirmaSenhaUsuario, $nascimentoUsuario, $permUsuario);
            if ($result === TRUE) {
                $verificar->insertNewUser();
                echo "<div class='alert alert-success' role='alert'>
                        Usuário inserido com sucesso!
                    </div>";
            }else {
                echo "<script>window.alert('".$result."')</script>";
            };
        $verificar->close();
    }
?>

    <table class="table table-striped">
    <thead>
        <th colspan="6" scape="col">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="navbar-brand">Usuários</a>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">Adicionar novo</button>
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
        <th scope="col">E-mail</th>
        <th scope="col">Data de Nascimento</th>
        <th scope="col">Permissão</th>
        <th scope="col"><button type="submit" name="alterar" class="btn btn-secondary">Ir para ações</button></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php 
                $usuarios = new ADMIN();
                    $datas = $usuarios->getAllUsers();

                    foreach ($datas as $key) {
                    echo "<tr>";
                    echo "<th scope='row'>".$key['id']."</th>";
                    echo "<td>".$key['nome']."</td>";
                    echo "<td>".$key['email']."</td>";
                    echo "<td>".date("m/d/Y", strtotime($key['data_nascimento']))."</td>";
                    echo "<td>".$key['perm']."</td>";
                    echo "<td><input type='checkbox' name='selected[]' value='".$key['id']."'/></td>";
                    echo "</tr>";

                    }
                $usuarios->close();
            ?>
        </tr>
    </tbody>
    </form>
    </table>


    <form method="post">
    <div class="modal" tabindex="-1" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Adicionar novo usuário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Nome:</b></label>
                <div class="col-sm-10">
                <input type="text" name="nome" class="form-control" id="inputName3">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail3">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Senha:</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" name="senha" id="inputPassword3" onchange='check_pass();'>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Confirmar Senha:</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" name="confirma_senha" id="inputPassword3" onchange='check_pass();'>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputDate3" class="col-sm-2 col-form-label">Data Nascimento:</label>
                <div class="col-sm-10">
                <input type="date" class="form-control" name="nascimento" id="inputDate3">
                </div>
            </div>

            <fieldset class="form-group">
                <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Permissão:</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="perm" id="gridRadios1" value="0" checked>
                    <label class="form-check-label" for="gridRadios1">
                        Primeiro
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="perm" id="gridRadios2" value="1">
                    <label class="form-check-label" for="gridRadios2">
                        Segundo
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="perm" id="gridRadios3" value="2">
                    <label class="form-check-label" for="gridRadios3">
                        Terceiro
                    </label>
                    </div>
                </div>
                </div>
            </fieldset>

            <script>
            function check_pass() {
                if (document.getElementsByName('senha')[0].value == document.getElementsByName('confirma_senha')[0].value) {
                    document.getElementsByName('confirma_senha')[0].classList.remove('is-invalid');
                } else {
                    document.getElementsByName('confirma_senha')[0].classList.add('is-invalid');
                }
            }
            </script>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" name="inserir" class="btn btn-primary">Adicionar</button>
        </div>
        </div>
    </div>
    </div>
    </form>

</body>
</html>
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
    <link href="../layout/css/sidebar.css" rel="stylesheet">
    <script type="text/javascript" src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

    <?php
        require_once "../layout/dashboard.php";
        
        $info = new ADMIN();
            $datas = $info->getUserDatas($_GET['id']);
    ?>

    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand">Editar usuário</a>
    </nav>

    <form method="post" action="alterar_usuario.act.php">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="inputNome">Nome:</label>
                <input type="text" name="nome" class="form-control" id="inputNome" value="<?php echo $datas['nome']; ?>">
            </div>
            <div class="form-group">
                <label for="inputEmail">E-mail:</label>
                <input type="email" name="email" class="form-control" id="inputEmail" value="<?php echo $datas['email']; ?>">
            </div>
            <div class="form-group">
                <label for="inputDate">Data de Nascimento:</label>
                <input type="date" name="nascimento" class="form-control" id="inputDate" value="<?php echo $datas['data_nascimento']; ?>">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPerm">Permissão:</label>
                    <select id="inputPerm" name="perm" class="form-control">
                        <option value="0" <?php if($datas['perm']=="1"){echo "selected";}?>>Administrador</option>
                        <option value="1" <?php if($datas['perm']=="2"){echo "selected";}?>>Nível 1</option>
                        <option value="2" <?php if($datas['perm']=="3"){echo "selected";}?>>Nível 2</option>
                        <option value="3" <?php if($datas['perm']=="4"){echo "selected";}?>>Nível 3</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCond">Condição:</label>
                    <select id="inputCond" name="cond" class="form-control">
                        <option value="enable" <?php if($datas['condicao']=="enable"){echo "selected";}?>>Habilitado</option>
                        <option value="disable" <?php if($datas['condicao']=="disable"){echo "selected";}?>>Desabilitado</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputPassword">Senha:</label>
                <input type="password" name="senha" class="form-control" id="inputPassword" onchange='check_pass();'>
                </div>
                <div class="form-group col-md-6">
                <label for="inputCPassword">Confirmar Senha:</label>
                <input type="password" name="confirma_senha" class="form-control" id="inputCPassword" onchange='check_pass();'>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <span class="navbar-text">
                    - Não modifique campos em que não deseja editar (inclui-se a senha).
                </span>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <input type="hidden" name="id" value="<?php echo $datas['id']; ?>">
                <a href="index.php"><button type="button" class="btn btn-outline-secondary">Voltar</button></a>
                <button type="submit" class="btn btn-outline-primary">Salvar alterações</button>
            </li>
        </ul>
    </nav>

    </form>

    <script>
        function check_pass() {
            if (document.getElementsByName('senha')[0].value == document.getElementsByName('confirma_senha')[0].value) {
                document.getElementsByName('confirma_senha')[0].classList.remove('is-invalid');
            } else {
                document.getElementsByName('confirma_senha')[0].classList.add('is-invalid');
            }
        }
    </script>

</body>
</html>
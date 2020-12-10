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
    <script src="loads/edit_usuario.js"></script>
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

    <form method="post" action="">
    <div class="card">
        <div class="card-body">
            <div id="alert" role="alert"></div>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" class="form-control" id="nome" value="<?php echo $datas['nome']; ?>">
                <div class="invalid-feedback">
                    Informe um nome.
                </div>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo $datas['email']; ?>">
                <div class="invalid-feedback">
                    Informe um e-mail válido.
                </div>
            </div>
            <div class="form-group">
                <label for="nascimento">Data de Nascimento:</label>
                <input type="date" name="nascimento" class="form-control" id="nascimento" value="<?php echo $datas['data_nascimento']; ?>">
                <div class="invalid-feedback">
                    Informe uma data de nascimento.
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="perm">Permissão:</label>
                    <select id="perm" name="perm" class="form-control">
                        <option value="1" <?php if($datas['perm']=="1"){echo "selected";}?>>Administrador</option>
                        <option value="2" <?php if($datas['perm']=="2"){echo "selected";}?>>A.M</option>
                        <option value="3" <?php if($datas['perm']=="3"){echo "selected";}?>>C.M</option>
                        <option value="4" <?php if($datas['perm']=="4"){echo "selected";}?>>M.M</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="condicao">Condição:</label>
                    <select id="condicao" name="cond" class="form-control">
                        <option value="enable" <?php if($datas['condicao']=="enable"){echo "selected";}?>>Habilitado</option>
                        <option value="disable" <?php if($datas['condicao']=="disable"){echo "selected";}?>>Desabilitado</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" class="form-control" id="senha">
                </div>
                <div class="form-group col-md-6">
                <label for="confirma_senha">Confirmar Senha:</label>
                <input type="password" name="confirma_senha" class="form-control" id="confirma_senha">
                <div class="invalid-feedback">
                    As senhas não conferem.
                </div>
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
                <input type="hidden" name="id" value="<?php echo $datas['id']; ?>" id="id">
                <a href="index.php"><button type="button" class="btn btn-outline-secondary">Voltar</button></a>
                <button type="button" class="btn btn-outline-primary" id="submit">Salvar alterações</button>
            </li>
        </ul>
    </nav>

    </form>

    <?php
        $info->close();
    ?>

</body>
</html>
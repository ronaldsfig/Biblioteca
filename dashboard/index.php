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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../layout/css/sidebar.css">
    <script type="text/javascript" src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="loads/adicionar_usuario.js"></script>
</head>
<body>
    <?php

        require_once "../layout/dashboard.php"; 

    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="navbar-brand">Usuários</a>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">Adicionar</button>
            </li>
        </ul>
    </nav>

    <div class="card">
    <div class="card-body">
    <table id="tabela" class="table table-responsive-lg table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th>Registro</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Data de Nascimento</th>
            <th>Permissão</th>
            <th>Condição</th>
            <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // <>EXIBE UMA LISTA DOS USUÁRIOS DO SISTEMA

                $usuarios = new ADMIN();
                    $datas = $usuarios->getAllUsers();
                    foreach ($datas as $key):
            ?>
            <tr>
                <th><?php echo $key['id']; ?></th>
                <td><?php echo $key['nome']; ?></td>
                <td><?php echo $key['email']; ?></td>
                <td><?php echo date("d/m/Y", strtotime($key['data_nascimento'])); ?></td>
                <td><?php switch($key['perm']){case '1': echo "Administrador";break; case 2: echo "A.M";break; case 3: echo "C.M";break; case 4: echo "M.M";break;}; ?></td>
                <td><?php if($key['condicao'] == 'enable'){echo "Habilitado";}else{echo "Desabilitado";}; ?></td>
                <td><a href="alterar_usuario.php?id=<?php echo $key['id']; ?>"><button class="btn btn-outline-info">Editar</button></a></td>
            </tr>
            <?php
                    endforeach;
                $usuarios->close();

            // </>EXIBE UMA LISTA DOS USUÁRIOS DO SISTEMA
            ?>
        </tbody>
    </table>
    </div>
    </div>

    <form method="post" name="f1" action="">
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

                <div id="alert" role="alert"></div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Nome:</b></label>
                    <div class="col-sm-10">
                    <input type="text" name="nome" class="form-control" id="nome">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" onblur='check_email(f1.email)' id="email">
                    <div class="invalid-feedback">
                        Informe um e-mail válido.
                    </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="senha" class="col-sm-2 col-form-label">Senha:</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" name="senha" id="senha" onchange='check_pass();'>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="confirma_senha" class="col-sm-2 col-form-label">Confirmar Senha:</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" name="confirma_senha" id="confirma_senha" onchange='check_pass();'>
                    <div class="invalid-feedback">
                        As senhas não conferem.
                    </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nascimento" class="col-sm-2 col-form-label">Data Nascimento:</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control" name="nascimento" id="nascimento">
                    </div>
                </div>

                <fieldset class="form-group">
                    <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Permissão:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="perm" id="perm2" value="2" checked>
                        <label class="form-check-label" for="perm2">
                            A.M
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="perm" id="perm3" value="3">
                        <label class="form-check-label" for="perm3">
                            C.M
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="perm" id="perm4" value="4">
                        <label class="form-check-label" for="perm4">
                            M.M
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="perm" id="perm1" value="1">
                        <label class="form-check-label" for="perm1">
                            Administrador
                        </label>
                        </div>
                    </div>
                    </div>
                </fieldset>

                <script>
                    function check_email(field) {
                        usuario = field.value.substring(0, field.value.indexOf("@"));
                        dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);

                        if ((usuario.length >=1) &&
                            (dominio.length >=3) &&
                            (usuario.search("@")==-1) &&
                            (dominio.search("@")==-1) &&
                            (usuario.search(" ")==-1) &&
                            (dominio.search(" ")==-1) &&
                            (dominio.search(".")!=-1) &&
                            (dominio.indexOf(".") >=1)&&
                            (dominio.lastIndexOf(".") < dominio.length - 1)) {
                            document.getElementsByName('email')[0].classList.remove('is-invalid');
                            document.getElementById('adicionar').disabled = false;
                        }
                        else{
                            document.getElementsByName('email')[0].classList.add('is-invalid');
                            document.getElementById('adicionar').disabled = true;
                        }
                    }

                    function check_pass() {
                        if (document.getElementsByName('senha')[0].value == document.getElementsByName('confirma_senha')[0].value) {
                            document.getElementsByName('confirma_senha')[0].classList.remove('is-invalid');
                            document.getElementById('adicionar').disabled = false;
                        } else {
                            document.getElementsByName('confirma_senha')[0].classList.add('is-invalid');
                            document.getElementById('adicionar').disabled = true;
                        }
                    }
                </script>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" name="inserir" class="btn btn-outline-primary" id="adicionar">Adicionar</button>
            </div>
            </div>
        </div>
    </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#tabela').DataTable( {
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Não há registros disponíveis",
                    "infoFiltered": "(Filtrado de _MAX_ registros no total)",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    }
                }
            } );
        } );
    </script>
    
</body>
</html>
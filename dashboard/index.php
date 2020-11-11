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

        // <>VERIFICA SE HOUVE UMA TENTATIVA DE ADICIONAR UM USUARIO

        if (isset($_SESSION['usuario_adicionado'])) {
            echo "<div class='alert alert-success' role='alert'>Usuário inserido com sucesso!</div>";
        }
        unset($_SESSION['usuario_adicionado']);
        
        if (isset($_SESSION['usuario_nao_adicionado'])) {
            echo "<div class='alert alert-danger' role='alert'>".$_SESSION['usuario_nao_adicionado']."</div>";
        }
        unset($_SESSION['usuario_nao_adicionado']);

        // </>VERIFICA SE HOUVE UMA TENTATIVA DE ADICIONAR UM USUARIO
    ?>

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
                <div class="form-group">
                    <select class="form-control" id="exampleFormControlSelect1">
                    <option>Todas as permissões</option>
                    <option>Administrador</option>
                    <option>Nível 1</option>
                    <option>Nível 2</option>
                    <option>Nível 3</option>
                    </select>
                </div>
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav>

    <table id="dtBasicExample" class="table table-striped table-lg" cellspacing="0" width="100%">
        <form method="post">
        <thead>
            <tr>
            <th scope="col">Registro</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Permissão</th>
            <th scope="col">Condição</th>
            <th scope="col"><button type="submit" name="alterar" class="btn btn-secondary">Ir para ações</button></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php 
                // <>EXIBE UMA LISTA DOS USUÁRIOS DO SISTEMA

                    $usuarios = new ADMIN();
                        $datas = $usuarios->getAllUsers();
                        foreach ($datas as $key):
                ?>
                <tr>
                    <th scope='row'><?php echo $key['id']; ?></th>
                    <td><?php echo $key['nome']; ?></td>
                    <td><?php echo $key['email']; ?></td>
                    <td><?php echo date("m/d/Y", strtotime($key['data_nascimento'])); ?></td>
                    <td><?php echo $key['perm']; ?></td>
                    <td><?php
                        if ($key['condicao'] == 'enable') {
                            echo "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-check' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd' d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z'/>
                          </svg>";
                        }else {
                            echo "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-x-octagon' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd' d='M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z'/>
                            <path fill-rule='evenodd' d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/>
                          </svg>";
                        }
                    ?></td>
                    <td><input type='checkbox' name='selected[]' value=''></td>
                </tr>
                <?php
                        endforeach;
                    $usuarios->close();

                // </>EXIBE UMA LISTA DOS USUÁRIOS DO SISTEMA
                ?>
            </tr>
        </tbody>
        </form>
    </table>


    <form method="post" action="adicionar_usuario.act.php">
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
                            Nivel 1
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="perm" id="gridRadios2" value="1">
                        <label class="form-check-label" for="gridRadios2">
                            Nivel 2
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="perm" id="gridRadios3" value="2">
                        <label class="form-check-label" for="gridRadios3">
                            Nivel 3
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
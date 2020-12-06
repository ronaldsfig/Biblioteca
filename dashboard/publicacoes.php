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
</head>
<body>

    <?php
        require_once "../layout/dashboard.php"; 

        // <>VERIFICA SE HOUVE UMA TENTATIVA DE %

        if (isset($_SESSION['sucesso'])) {
            echo "<div class='alert alert-success'>".$_SESSION['sucesso']."</div>";
        }
        unset($_SESSION['sucesso']);
        
        if (isset($_SESSION['erro'])) {
            echo "<div class='alert alert-danger' role='alert'>".$_SESSION['erro']."</div>";
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
        <tbody>
            <?php 
            // <>EXIBE UMA LISTA DAS POSTAGENS DO SISTEMA

                $posts = new ADMIN();
                    $datas = $posts->getAllPosts();
                    foreach ($datas as $key):
            ?>
            <tr>
                <th><?php echo $key['id']; ?></th>
                <td><?php echo $key['nome']; ?></td>
                <td><?php echo $key['titulo']; ?></td>
                <td><?php echo $key['subtitulo']; ?></td>
                <td><?php echo $key['nome_arquivo']; ?></td>
                <td><?php echo date("d/m/Y", strtotime($key['data_postagem'])); ?></td>
                <td><?php echo $key['nome_perm']; ?></td>
                <td>
                <a href="../posts/<?php echo $key['nome_arquivo']?>"><button class="btn btn-outline-info">Visualizar</button></a>
                <a href="reciclar_publicacao.php?nome_arquivo=<?php echo $key['nome_arquivo']?>"><button class="btn btn-outline-danger">Arquivar</button></a>
                </td>
            </tr>
            <?php
                    endforeach;
                $posts->close();

            // </>EXIBE UMA LISTA DAS POSTAGENS DO SISTEMA
            ?>
        </tbody>
    </table>
    </div>
    </div>

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
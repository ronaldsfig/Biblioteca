<?php
    session_start();
    include "../session/verify.php";
    include "../../classes/connect.class.php";
    include "../../classes/admin.class.php";

    if($_POST['verify'] === NULL){
        header("Location: ../index.php");
        exit;
    };
    
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
            <a href="actions/arq_post.php?nome_arquivo=<?php echo $key['nome_arquivo']?>"><button class="btn btn-outline-danger">Arquivar</button></a>
        </td>
    </tr>
<?php
    endforeach;
        $posts->close();

    // </>EXIBE UMA LISTA DAS POSTAGENS DO SISTEMA
?>
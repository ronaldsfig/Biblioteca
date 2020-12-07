<?php
    session_start();
    include "../../classes/connect.class.php";
    include "../../classes/user.class.php";
    include "../session/verify.php";

    $search = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

    if($search === NULL){
        header("Location: ../index.php");
        exit;
    };

    $posts = new USER($_SESSION['user']['perm']);
    $datas = $posts->getPosts($search);
    if ($datas === FALSE):
?>

    <div class="col" style="padding-right: 0; padding-left: 0">
    Não há publicações no momento.
    </div>

<?php
    else:
    foreach ($datas as $key):
?>

    <div class="col-6 col-md-4" style="padding-right: 5px; padding-left: 5px; padding-bottom: 5px">
    <div class="card">
        <div class="card-header">
            <b><?php echo $key['nome']?></b> (<?php echo $key['nome_perm'] ?>)
        </div>
        <div class="card-body">
            <p><h4><?php echo $key['titulo']?></h4></p>
            <p><?php echo $key['subtitulo']?></p>
            <a href="../posts/<?php echo $key['nome_arquivo']?>"><button type="button" class="btn btn-outline-info">Visualizar</button></a>
        </div>
        <div class="card-footer text-muted">
        Postado em <?php echo date("d/m/Y H:i", strtotime($key['data_postagem']));?>
        </div>
    </div>
    </div>

<?php
    endforeach;
    endif;
    $posts->close();
?>
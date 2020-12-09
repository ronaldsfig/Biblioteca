<?php 
    session_start();
    include "../session/verify.php";
    include "../../classes/connect.class.php";
    include "../../classes/admin.class.php";

    if($_POST['verify'] === NULL){
        header("Location: ../index.php");
        exit;
    };

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
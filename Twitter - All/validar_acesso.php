<?php
    session_start(); 
    require_once('db.class.php');
    $user = $_POST['usuario'];
    $password = md5($_POST['senha']);

    $sql = "SELECT id,usuario,email FROM usuarios WHERE usuario = '$user' AND senha = '$senha'";

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $resultado_id = msqli_query($link, $sql);
    
    if($resultado_id)
    {
        $dados_usuario = msqli_fetch_array($resultado_id);
        if(isset($dados_usuario['usuario']))
        {
            $_SESSION['id_usuario'] = $dados_usuario['id'];
            $_SESSION['usuario'] = $dados_usuario['usuario'];
            $_SESSION['email'] = $dados_usuario['email'];
            header('Location: home.php');
        }
        else
        {
            header('Location: index.php?erro=1');
        }
    }
    else
    {
        echo 'Erro na consulta, entre em contato com o admin do site';
    }
?>
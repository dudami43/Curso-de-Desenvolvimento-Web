<?php
    require_once('db.class.php');
    $user = $_POST['usuario'];
    $email = $_POST['email'];
    $password = md5($_POST['senha']);

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $usuario_existe = false;
    $email_existe = fasle;

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    if($resultado_id = mysqli_query($link,$sql))
    {
        $dados_usuario = mysqli_fetch_array($resultado_id);
        if(isset($dados_usuario['usuario']))
        {
            $usuario_existe = true;;
        }    
    }
    else{
        echo 'Erro';
    }

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    if($resultado_id = mysqli_query($link,$sql))
    {
        $dados_usuario = mysqli_fetch_array($resultado_id);
        if(isset($dados_usuario['email']))
        {
            $email_existe = true;
        }    
    }
    else{
        echo 'Erro';
    }

    if($usuario_existe || $email_existe)
    {
        $retorno_get = '';

        if($usuario_existe)
        {
            $retorno_get.="erro_usuario=1&";
        }
        if($email_existe)
        {
            $retorno_get.="erro_email=1&";
        }

        header('Location: inscrevase.php?'.$retorno_get);
        die();
    }

    $sql = "INSERT INTO usuarios(usuario, email, senha) VALUES ('$user','$email','$senha')";

    if(msqli_query($link, $sql))
    {
        echo 'Usuário registrado com sucesso';
    }
    else
    {
        echo 'Erro ao registrar o usuário';
    }
?>
<?php
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";

    include_once "config.inc.php";

    $conexao = new PDO(dsn, usuario, senha);

    $sql = "SELECT ID_USUARIO, NOME
            FROM USUARIO
            WHERE EMAIL = :email
            AND SENHA = :senha";

    $comando = $conexao->prepare($sql);

    $comando->bindValue(":email", $email);
    $comando->bindValue(":senha", md5($senha));

    $comando->execute();

    $registro = $comando->fetch();

    if($registro){
        session_start();
        $_SESSION['id'] = $registro['ID_USUARIO'];
        $_SESSION['nome'] = $registro['NOME'];
        header("location: listar.php");
    }else{
        header("location: login.html?auth_erro=Usuário ou senha incorretos");
    }
?>
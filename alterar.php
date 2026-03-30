<?php
include "config.inc.php";

$nome = isset($_POST['nome']) ? $_POST['nome'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$senha = isset($_POST['senha']) ? $_POST['senha'] : "";
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "";
$id = isset($_POST['id']) ? $_POST['id'] : "";

if($nome != "" && $email != ""){

    $conexao = new PDO(dsn, usuario, senha);

    $sql = "UPDATE USUARIO
            SET NOME = :nome,
                EMAIL = :email,
                SENHA = :senha,
                TIPO = :tipo
            WHERE ID_USUARIO = :id";

    $comando = $conexao->prepare($sql);

    $comando->bindValue(':nome', $nome);
    $comando->bindValue(':email', $email);
    $comando->bindValue(':senha', md5($senha));
    $comando->bindValue(':tipo', $tipo);
    $comando->bindValue(':id', $id);

    if ($comando->execute())
        echo "dados Atualizados com sucesso!";
    else
        echo "Erro ao atualizar";

} else
    echo "os dados não podem estar em branco...";
?>
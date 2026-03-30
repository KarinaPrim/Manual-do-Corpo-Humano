<?php
include "config.inc.php";

$id = isset($_GET['id']) ? $_GET['id'] : "";

if($id > 0 ){

    $conexao = new PDO(dsn, usuario, senha);

    $sql = "DELETE
            FROM USUARIO
            WHERE ID_USUARIO = :id";

    $comando = $conexao->prepare($sql);
    $comando->bindValue(':id', $id);

    if ($comando->execute())
        echo "Registro excluido com sucesso!";
    else
        echo "Erro ao excluir os dados";

} else
    echo "Erro ao excluir...";
?>
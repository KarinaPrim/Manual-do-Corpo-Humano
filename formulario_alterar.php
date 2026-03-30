<?php
include "config.inc.php"; 

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$usuario = array();

if ($id > 0){

    // abrir conexão com o banco
    $conexao = new PDO(dsn, usuario, senha);

    // montar consulta
    $sql = "SELECT *
            FROM USUARIO
            WHERE ID_USUARIO = :id";

    // preparar consulta
    $comando = $conexao->prepare($sql);

    // enviar parâmetros da consulta
    $comando->bindValue(':id', $id);

    // executar consulta
    $comando->execute();

    // listar os registros do banco
    $usuario = $comando->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar usuário</title>
</head>
<body>
    <form action="alterar.php" method="POST">
        <fieldset>
            <label for="id">Id:</label>
            <input type="text" name="id" id="id" readonly value="<?=isset($usuario)?$usuario['ID_USUARIO']:0?>">

            <label for="nome">nome</label>
            <input type="text" name="nome" id="nome" value="<?=isset($usuario)?$usuario['NOME']:0?>">

            <label for="email">email</label>
            <input type="text" name="email" id="email" value="<?=isset($usuario)?$usuario['EMAIL']:0?>">

            <label for="senha">senha</label>
            <input type="password" name="senha" id="senha" value="">

            <label for="tipo">tipo</label>
            <select name="tipo" id="tipo">
                <option value="aluno" <?=isset($usuario) && $usuario['TIPO']=='aluno'?'selected':''?>>Aluno</option>
                <option value="professor" <?=isset($usuario) && $usuario['TIPO']=='professor'?'selected':''?>>Professor</option>
            </select>

            <button type="submit">Alterar</button>
        </fieldset>
    </form>
</body>
</html>
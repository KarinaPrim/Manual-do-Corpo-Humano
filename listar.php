<?php
session_start();
if(!isset($_SESSION['id']))
    header("location: login.html");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de usuários</title>
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">
</head>

<body>
    <h1>Bem vindo <?= $_SESSION['nome'] ?></h1>
    <h3><a href="sair.php">sair</a></h3>
    <form action="" method="get">

        <label for="tipo">Tipo</label>
        <select name="tipo" id="tipo">
            <option value="">Selecione</option>
            <option value="1">Id</option>
            <option value="2">Nome</option>
            <option value="3">Email</option>
            <option value="4">Tipo</option>
        </select>

        <input type="text" name="filtro" id="filtro">

        <button type="submit">Filtrar</button>

    </form>

<br>

<?php

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 0;
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 0;

include "config.inc.php";

// abrir a conexão com o banco 
$conexao = new PDO(dsn, usuario, senha);

// montar a consulta
$sql = "SELECT * FROM USUARIO";

switch($tipo){
    case 1:
        $sql .= " WHERE ID_USUARIO = :filtro";
        break;
    case 2:
        $sql .= " WHERE NOME like :filtro";
        $filtro = '%'.$filtro.'%';
        break;
    case 3:
        $sql .= " WHERE EMAIL = :filtro";
        break;
    case 4:
        $sql .= " WHERE TIPO = :filtro";
        break;
}

// preparar a consulta
$comando = $conexao->prepare($sql);

// enviar parametros da consulta
if($tipo > 0)
    $comando->bindValue(':filtro', $filtro);

// executar a consulta
$comando->execute();

// listar os registros do banco
$registros = $comando->fetchAll();
?>

<table>
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Senha</th>
        <th>Tipo</th>
        <th>Alterar</th>
        <th>Excluir</th>
    </tr>

<?php
foreach ($registros as $usuario) {
    echo "<tr><td>" . $usuario['ID_USUARIO'] . "</td>" .
         "<td>" . $usuario['NOME'] . "</td>" .
         "<td>" . $usuario['EMAIL'] . "</td>" .
         "<td>" . $usuario['SENHA'] . "</td>" .
         "<td>" . $usuario['TIPO'] . "</td>" .
         "<td><a href='formulario_alterar.php?id=" . $usuario['ID_USUARIO'] . "'>Alterar</a></td>" .
         "<td><a href='formulario_deletar.php?id=" . $usuario['ID_USUARIO'] . "'>Excluir</a></td>" .
         "</tr>";
}
?>
</table>
</body>
</html>
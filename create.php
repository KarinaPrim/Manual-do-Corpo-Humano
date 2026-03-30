<?php
include "config.inc.php"; 

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';

if ($nome != ''){
    // CRUD de usuario
    // Conectar com banco de dados 

    $conexao = new PDO(dsn, usuario, senha); 

    // Create 
    // Montar sql
    $sql = 'INSERT INTO USUARIO (NOME, EMAIL, SENHA, TIPO, DATA_CADASTRO) 
            VALUES (:nome, :email, :senha, :tipo, NOW())';

    // Preparar comando para executar no banco de dados
    $comando = $conexao->prepare($sql);

    // Informar parametros
    $comando->bindValue(':nome', $nome);
    $comando->bindValue(':email', $email);
    $comando->bindValue(':senha', md5($senha));
    $comando->bindValue(':tipo', $tipo);

    // Executar um comando
    if ($comando->execute())
        echo 'Dados inseridos com sucesso!';
    else
        echo 'erro ao inserir dados no banco';
}
else
    echo "Informe um nome válido";
?>
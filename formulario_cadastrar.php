<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar usuário</title>
</head>
<body>
    <form action="create.php" method="POST">
        <fieldset>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">

            <label for="email">email</label>
            <input type="text" name="email" id="email">

            <label for="senha">senha</label>
            <input type="password" name="senha" id="senha">

            <!-- NOVO CAMPO tipo -->
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo">
                <option value="aluno">Aluno</option>
                <option value="professor">Professor</option>
            </select>

            <button type="submit">Cadastrar</button>
        </fieldset>
    </form>
</body>
</html>
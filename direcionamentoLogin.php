<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title> Direcionamento Login </title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>

<body>
<header>
    <img class="img-header" src="./logo.png" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
</header>  

    <H1> Selecionar tipo de Login </H1>
    <form method="post" action="">
        <div>
            <button class="botoes" name="secretaria" type="submit">Login Secretaria</button>
            <button class="botoes" name="ilpi" type="submit">Login ILPI</button>
            <button class="botoes" name="cadastroUsuario" type="submit">Cadastrar Usuário</button>
        </div>
    </form>
</body>
<?php
if (isset($_POST['secretaria'])) 
{
    header("location: ./admin/loginAdmin.php");
}
if (isset($_POST['ilpi'])) {
    header("location: ./ilpi/loginIlpi.php");
}
if (isset($_POST['cadastroUsuario'])) {
    header("location: ./cadastroUsuario.php");
}
?>

</html>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title> Perfil Administrativo </title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
<header>
    <img class="img-header" src="../logo.png" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
</header>  

    <H1> Perfil administrativo </H1>
    <form method="post" action="">
        <div>
            <button class="botoes" name="indicadores" type="submit">Indicadores</button>
            <button class="botoes" name="cadastro" type="submit">Cadastro de ILPIs</button>
            <button class="botoes" name="dadosILPI" type="submit">Dados da ILPIs</button>
        </div>
    </form>
</body>
<?php
session_start();
if (isset($_POST['indicadores'])) 
{
    header("location: ./indicadores.php");
}
if (isset($_POST['cadastro'])) {
    header("location: ./cadastroIlpi.php");
}
if (isset($_POST['dadosILPI'])) {
    header("location: ./paginaTabelaIlpi.php");
}
?>

</html>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title> Perfil Administrativo </title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
<header>
    <img class="img-header" src="./logo.jpg" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
</header>  

    <H1> Perfil administrativo </H1>
    <div>
        <button class="botoes" name="indicadores"> Indicadores </button>
        <button class="botoes" name="cadastro"> Cadastro de ILPIs </button>
        <button class="botoes" name="dadosILPI"> Dados da ILPIs </button>
    </div>
</body>
<?php
session_start();
if (isset($_POST['indicadores'])) {
    header("location: ./admin/indicadores.php");
}
if (isset($_POST['cadastro'])) {
    header("location: ./admin/cadastroIlpi.php");
}
if (isset($_POST['dadosILPI'])) {
    header("location: ./admin/paginaTabelaIlpi.php");
}
?>

</html>
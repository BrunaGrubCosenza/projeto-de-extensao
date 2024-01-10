<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title> perfil administrativo </title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <H1> Perfil administrativo </H1>
    <div>
        <button class="botoes" name="indicadores"> indicadores </button>
        <button class="botoes" name="cadastro"> Cadastro de ILPIs </button>
        <button class="botoes" name="dadosILPI"> Dados da ILPIs </button>
    </div>
</body>
<?php
if (isset($_POST['indicadores'])) {
    header("location: indicadores.php");
}
if (isset($_POST['cadastro'])) {
    header("location: cadastro.php");
}
if (isset($_POST['dadosILPI'])) {
    header("location: paginadados.php");
}
?>

</html>
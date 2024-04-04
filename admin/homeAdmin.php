<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title> Perfil Administrativo </title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
    <header>
        <img class="img-header" src="../logo.png"
            alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
        <button id="logoutButton">Sair do Sistema</button>
    </header>
    <h1 class="h1-estilizado"> Perfil administrativo </h1>

    <form method="post" action="">
        <div class="div-botoes-home">
            <button class="botoes-home" name="indicadores" type="submit">Indicadores</button>
            <button class="botoes-home" name="dadosILPI" type="submit">Dados da ILPIs</button>
            <button class="botoes-home" name="cadastro" type="submit">Cadastro de ILPIs</button>
        </div>
    </form>

    <script>
        document.getElementById('logoutButton').addEventListener('click', function () {
            // Aqui você pode colocar a lógica para o logout, como limpar a sessão do usuário
            // e redirecioná-lo para a página de login
            window.location.href = "loginAdmin.php";
        });
    </script>
</body>
<?php
if (isset($_POST['indicadores'])) {
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
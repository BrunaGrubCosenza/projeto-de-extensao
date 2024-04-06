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
        <div class="div-botoes-inicio">
            <button class="botoes-inicio" name="ilpi" type="submit">ILPI</button>
            <button class="botoes-inicio" name="secretaria" type="submit">Secretaria</button>
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
?>

</html>
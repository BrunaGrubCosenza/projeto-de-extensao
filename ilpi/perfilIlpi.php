<html lang="pt-BR"> 
<head> 
  <meta charset="utf-8"> 
  <title> Perfil ILPI </title> 
  <link rel="stylesheet" href="../css/estilo.css">
</head> 

<body>
  <header>
    <img class="img-header" src="../logo.png" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
  </header> 

  <h1> Perfil </h1>

<form method="post" action="">
        <div>
            <button class="botoes" name="atualizarDadosIlpi" type="submit"> Atualizar Dados da Ilpi </button>
        </div>
    </form>

<?php

if(isset($_POST['atualizarDadosIlpi']))
   {
   header("location: ./atualizarDadosIlpi.php");
   }

?>

  
</body>
</html>
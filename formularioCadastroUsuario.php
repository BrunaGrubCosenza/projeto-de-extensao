<!DOCTYPE html>
<html lang="pt-BR">
 
<head>
  <meta charset="utf-8">
  <title> Cadastro de Usuário</title>
  <link rel="stylesheet" href="./css/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
      <img class="img-header" src="./logo.png" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
      <nav class="nav-header">
    <a href="../projeto-de-extensao/admin/homeAdmin.php"><i class="fa-solid fa-house"></i></a>
  </nav>
    </header>  

  <h1> Cadastrar Usuário </h1>

  <form action="cadastroUsuario.php" method="post">
    <fieldset>
      <legend> Formulário </legend>

      <label class="alinha"> Senha: </label>
      <input type="password" name="senha" required> <br>

      <label class="alinha"> Usuário é Administrador: </label> 
      <input type="radio" class="alinha-botao" name="usuarioAdmin" value="Sim" required> <label> Sim </label> 
      <input type ="radio" class="alinha-botao" name="usuarioAdmin" value="Não" required> <label> Não </label> <br>
    
      <div>
        <button name="cadastrar"> Cadastrar usuário </button>
      </div>
    </fieldset>
  </form>

  <?php

  require "./includes/dados-conexao.inc.php";
  require "./includes/conectar.inc.php";
  require "./includes/abrir-banco.inc.php";
  require "./includes/definir-charset.inc.php";

  if (isset($_POST['cadastrar'])) {
    require "./includes/cadastrarUsuario.inc.php";
  }

  require "./includes/desconectar.inc.php";

  ?>
</body>

</html>
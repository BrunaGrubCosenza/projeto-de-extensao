<!DOCTYPE html> 
<html lang="pt-BR"> 
<head> 
  <meta charset="utf-8"> 
  <title> Login Administrativo </title> 
  <link rel="stylesheet" href="estilo.css">
</head> 

<body>
  <header>
      <img class="img-header" src="./logo.jpg" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
  </header>

  <h1> Login </h1>

  <form action="loginAdmin.php" method="post">
   <fieldset>
    <legend> Validação de acesso </legend>
    <label class="alinha"> Login: </label>
    <input type="text" name="login" autofocus> <br>

    <label class="alinha"> Senha: </label>
    <input type="password" name="senha"> <br>

    <div>
     <button name="logar"> Entrar </button>

     <p><a href="">Esqueci minha senha</a></p>
    </div>
   </fieldset>
  </form>

  <?php   
   if(isset($_POST['logar']))
    {
    header("location: logar.php");
    }
  ?>
</body> 
</html> 
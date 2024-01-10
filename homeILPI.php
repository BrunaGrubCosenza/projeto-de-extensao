<!DOCTYPE html> 
<html lang="pt-BR"> 
<head> 
  <meta charset="utf-8"> 
  <title> Login de usuário com PHP </title> 
  <link rel="stylesheet" href="formata-login.css">
</head> 

<body>
  <h1> Login ILPI </h1>

  <form action="home.php" method="post">
   <fieldset>
    <legend> Validação de acesso </legend>
    <label class="alinha"> Login: </label>
    <input type="text" name="login" autofocus> <br>

    <label class="alinha"> Senha: </label>
    <input type="password" name="senha" autofocus> <br>

    <div>
     <button name="cadastrar"> Cadastrar usuário </button>
     <button name="logar"> Logar usuário </button>
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
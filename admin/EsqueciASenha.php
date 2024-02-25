<html lang="pt-BR"> 
<head> 
  <meta charset="utf-8"> 
  <title> Esqueci minha senha </title> 
  <link rel="stylesheet" href="../css/estilo.css">
</head> 
<body>
  <header>
    <img class="img-header" src="../logo.png" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
  </header> 

  <h1> Recuperar senha </h1>
  <form action="esqueciASenha.php" method="post">
    <p>Para recuperar seu acesso, precisamos do seu E-mail.</p>

    <label class="alinha"> E-mail </label>
    <input type="email" name="email" autofocus placeholder="Digite o e-mail"> <br>

    <div>
     <button class="botoes" name="mandarEmail" type="submit">Continuar</button>
    </div>

  </form>

  <p> Lembrou? <a href="loginAdmin.php">Clique aqui</a> para logar! </p>

</body>
</html>
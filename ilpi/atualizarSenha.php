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

  <h1> Nova senha </h1>

  <form action="atualizarSenha.php" method="post">

  <p>Insira sua nova senha de acesso</p>
  <label class="alinha"> Senha </label>
  <input type="password" name="senha" required> <br>


  <label class="alinha"> Confirmação de senha </label>
  <input type="password" name="confirmacaoSenha" required> <br>

  <button class="botoes" name="salvarNovaSenha" type="submit">Salvar</button>

  </form>

</body>
</html>
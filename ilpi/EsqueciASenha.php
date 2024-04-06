<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title>Alteração de Senha</title>
  <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
  <header>
    <img class="img-header" src="../logo.png"
      alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
    <a href="loginIlpi.php"><button class="voltar">Voltar</button></a>
  </header>

  <h1>Alteração de Senha</h1>

  <?php
  // Inclui os arquivos de conexão com o banco de dados e configurações
  require "../includes/dados-conexao.inc.php";
  require "../includes/conectar.inc.php";
  require "../includes/abrir-banco.inc.php";
  require "../includes/definir-charset.inc.php";

  // Lógica para alteração de senha
  if (isset($_POST['alterarSenha'])) {
    $email = $_POST['email'];
    $novaSenha = $_POST['novaSenha'];

    // Criptografar a nova senha usando Argon2i
    $hashedPassword = password_hash($novaSenha, PASSWORD_ARGON2I);

    // Atualizar a senha no banco de dados
    $sqlUpdate = "UPDATE usuarios SET senha_hash='$hashedPassword' WHERE email='$email'";

    if ($conexao->query($sqlUpdate) === TRUE) {
      echo "Senha alterada com sucesso.";
    } else {
      echo "Erro ao alterar a senha: " . $conexao->error;
    }
  }
  ?>

  <!-- Formulário de alteração de senha -->
  <form action="" method="post">
    <fieldset>
      <legend>Alteração de Senha</legend>
      <label class="alinha">Nova Senha:</label>
      <input type="password" name="novaSenha" required> <br>

      <label class="alinha">Confirme a Nova Senha:</label>
      <input type="password" name="confirmarSenha" required> <br>

      <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>">

      <div>
        <button name="alterarSenha">Alterar Senha</button>
      </div>
    </fieldset>
  </form>
</body>

</html>

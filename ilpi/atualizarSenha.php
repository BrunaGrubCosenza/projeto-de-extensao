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

  // Verifica se o usuário está autenticado e se é o primeiro acesso
  session_start();
  if (!isset($_SESSION['primeiro_acesso']) || !$_SESSION['primeiro_acesso']) {
    header("location: loginIlpi.php");
    exit();
  }

  // Lógica para alteração de senha
  if (isset($_POST['alterarSenha'])) {
    $email = $_SESSION['email'];
    $novaSenha = $_POST['novaSenha'];
    $confirmarSenha = $_POST['confirmarSenha'];

    // Verifica se as senhas correspondem
    if ($novaSenha === $confirmarSenha) {
      // Criptografar a nova senha usando Argon2i
      $senhaCriptografada = password_hash($novaSenha, PASSWORD_ARGON2I);

      // Atualizar a senha no banco de dados
      $sqlAtualizarSenha = "UPDATE usuarios SET senha_hash='$senhaCriptografada' WHERE email='$email'";

      if ($conexao->query($sqlAtualizarSenha) === TRUE) {
        echo "Senha alterada com sucesso.";
        // Atualiza o status de primeiro acesso para false
        $sqlAtualizarPrimeiroAcesso = "UPDATE usuarios SET primeiro_acesso = false WHERE email='$email'";
        if ($conexao->query($sqlAtualizarPrimeiroAcesso) === TRUE) {
          echo " O status foi atualizado";
        } else {
          echo "Erro ao atualizar o status: " . $conexao->error;
        }
      } else {
        echo "Erro ao alterar a senha: " . $conexao->error;
      }
    } else {
      echo "As senhas digitadas não correspondem.";
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

      <div>
        <button name="alterarSenha">Alterar Senha</button>
      </div>
    </fieldset>
  </form>
</body>

</html>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title>Recuperação de Senha</title>
  <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
  <header>
    <img class="img-header" src="../logo.png"
      alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
    <a href="loginIlpi.php"><button class="voltar">Voltar</button></a>
  </header>

  <h1>Recuperação de Senha</h1>

  <?php
  // Inclui os arquivos de conexão com o banco de dados e configurações
  require "../includes/dados-conexao.inc.php";
  require "../includes/conectar.inc.php";
  require "../includes/abrir-banco.inc.php";
  require "../includes/definir-charset.inc.php";

  // Lógica para recuperação de senha
  if (isset($_POST['recuperarSenha'])) {
    // Dados do formulário
    $email = $_POST['email'];

    // Verificar se o e-mail do usuário está presente no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
      // E-mail do usuário encontrado
      // Redireciona para a seção de alteração de senha
      echo "<script>window.location.href='EsqueciASenha.php?email=$email';</script>";
    } else {
      echo "E-mail do usuário não encontrado.";
    }
  }

  // Lógica para alteração de senha
  if (isset($_POST['alterarSenha'])) {
    $email = $_POST['email'];
    $novaSenha = $_POST['novaSenha'];
    $confirmarId = $_POST['confirmarId'];

    // Verificar se o ID inserido pelo usuário corresponde ao ID esperado
    if (isset($_POST['alterarSenha'])) {
      $email = $_POST['email'];
      $novaSenha = $_POST['novaSenha'];
      $confirmarId = $_POST['confirmarId'];

      // Recuperar o ID do usuário do banco de dados usando o e-mail fornecido
      $sql = "SELECT id FROM usuarios WHERE email = '$email'";
      $resultado = $conexao->query($sql);

      if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $idEsperado = $row['id'];

        // Verificar se o ID inserido pelo usuário corresponde ao ID esperado
        if ($confirmarId == $idEsperado) {
          // Criptografar a nova senha usando Argon2i
          $hashedPassword = password_hash($novaSenha, PASSWORD_ARGON2I);

          // Atualizar a senha no banco de dados
          $sqlUpdate = "UPDATE usuarios SET senha_hash='$hashedPassword' WHERE email='$email'";

          if ($conexao->query($sqlUpdate) === TRUE) {
            echo "Senha alterada com sucesso.";
          } else {
            echo "Erro ao alterar a senha: " . $conexao->error;
          }
        } else {
          echo "ID incorreto. A senha não pôde ser alterada.";
        }
      } else {
        echo "E-mail do usuário não encontrado.";
      }
    }
  }
  ?>

  <!-- Formulário de recuperação de senha -->
  <form action="" method="post">
    <fieldset>
      <legend>Recuperação de Senha</legend>
      <label class="alinha">Informe seu E-mail:</label>
      <input type="email" name="email" required> <br>

      <div>
        <button name="recuperarSenha">Recuperar Senha</button>
      </div>
    </fieldset>
  </form>

  <!-- Formulário de alteração de senha -->
  <?php if (isset($_GET['email'])) { ?>
    <form action="" method="post">
      <fieldset>
        <legend>Alteração de Senha</legend>
        <label class="alinha">Nova Senha:</label>
        <input type="password" name="novaSenha" required> <br>

        <label class="alinha">Confirme seu ID:</label>
        <input type="text" name="confirmarId" required> <br>

        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">

        <div>
          <button name="alterarSenha">Alterar Senha</button>
        </div>
      </fieldset>
    </form>
  <?php } ?>
</body>

</html>
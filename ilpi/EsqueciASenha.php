<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title>Atualizar Senha</title>
  <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
  <header>
    <img class="img-header" src="../logo.png"
      alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
  </header>

  <h1>Atualizar Senha</h1>

  <?php
  session_start();
  require "../includes/dados-conexao.inc.php";
  require "../includes/conectar.inc.php";
  require "../includes/abrir-banco.inc.php";
  require "../includes/definir-charset.inc.php";

  // Verifica se o formulário foi submetido
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se a nova senha foi enviada
    if (!empty($_POST["novaSenha"])) {
      // Recupera os dados do formulário
      $novaSenha = $_POST["novaSenha"];
      $email = $_GET["email"];

      // Criptografa a nova senha usando Argon2i
      $senhaCriptografada = password_hash($novaSenha, PASSWORD_ARGON2I);

      // Atualiza a senha no banco de dados
      $sqlUpdate = "UPDATE $nomeDaTabela2 SET senha_hash='$senhaCriptografada' WHERE email='$email'";
      if ($conexao->query($sqlUpdate) === TRUE) {
        echo "<p>Senha atualizada com sucesso.</p>";
      } else {
        echo "<p>Ocorreu um erro ao atualizar a senha: " . $conexao->error . "</p>";
      }

      // Fecha a conexão com o banco de dados
      $conexao->close();
    } else {
      echo "<p>Por favor, preencha todos os campos.</p>";
    }
  }
  ?>

  <!-- Formulário para atualizar a senha -->
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?email=" . $_GET["email"]; ?>" method="post">
    <fieldset>
      <legend>Nova Senha</legend>
      <label for="novaSenha">Nova Senha:</label>
      <input type="password" id="novaSenha" name="novaSenha" required><br>
      <button type="submit">Atualizar Senha</button>
    </fieldset>
  </form>
</body>

</html>

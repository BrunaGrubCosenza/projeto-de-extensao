<!DOCTYPE html> 
<html lang="pt-BR"> 
<head> 
  <meta charset="utf-8"> 
  <title> Login ILPI </title> 
  <link rel="stylesheet" href="../css/estilo.css">
</head> 

<body>
  <header>
    <img class="img-header" src="../logo.png" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
  </header>

  <h1> Login </h1>

  <form action="loginIlpi.php" method="post">
   <fieldset>
    <legend> Validação de acesso </legend>
    <label class="alinha"> Email: </label>
    <input type="text" name="email" autofocus> <br>

    <label class="alinha"> Senha: </label>
    <input type="password" name="senha"> <br>

    <div>
     <button name="logar"> Entrar </button>
     <button name="recover"> Esqueci minha senha </button>
    </div>
   </fieldset>
  </form>

<?php
session_start();
require "../includes/dados-conexao.inc.php";
require "../includes/conectar.inc.php";
require "../includes/abrir-banco.inc.php";
require "../includes/definir-charset.inc.php";

// Verifica se o formulário de login foi submetido
if (isset($_POST["logar"])) {
    // Verifica se houve erro na conexão
    if ($conexao->connect_error) {
      die("Conexão falhou: " . $conexao->connect_error);
    }

    // Escapa os caracteres especiais para evitar injeção de SQL
    $email = $conexao->real_escape_string($_POST['email']);
    $senha = $conexao->real_escape_string($_POST['senha']);

    // Consulta SQL para verificar as credenciais do usuário
    $sql = "SELECT senha_hash, email, cnpj_ilpi FROM $nomeDaTabela2 WHERE email = '$email'";

    // Executa a consulta SQL
    $resultado = $conexao->query($sql) or exit($conexao->error);

    $vetorRegistro = $resultado->fetch_array();
    if(!isset($vetorRegistro)){
      echo "<p>Login ou senha incorretos. Tente novamente.</p>";
      exit();
    }

    $senhaCriptografada = $vetorRegistro['senha_hash'];
    $senhaCorreta = password_verify($senha, $senhaCriptografada);

    if($senhaCorreta){
      $cnpj_ilpi = $vetorRegistro['cnpj_ilpi'];
      session_start();
      $_SESSION['conectado'] = true;
      header("location: perfilIlpi.php?cnpj_ilpi=$cnpj_ilpi");
      exit();
    }
   
    else
     {
      echo "<p>Login ou senha incorretos. Tente novamente.</p>";
     }
        // Verifica se a senha fornecida corresponde ao hash no banco de dados
    }


    // Fecha a conexão com o banco de dados
    $conexao->close();
?>

</body> 
</html>
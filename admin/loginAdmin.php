<!DOCTYPE html> 
<html lang="pt-BR"> 
<head> 
  <meta charset="utf-8"> 
  <title> Login Administrativo </title> 
  <link rel="stylesheet" href="../css/estilo.css">
</head> 

<body>
  <header>
      <img class="img-header" src="../logo.png" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
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
     <button  name="login"> Entrar </button>

     <button name="recuperarSenha"> Esqueci minha senha </button>
    </div>
   </fieldset>
  </form>

  <?php   
   if(isset($_POST['logar']))
    {
    header("location: ./homeAdmin.php");
    }
    if(isset($_POST['recuperarSenha']))
    {
    header("location: ./EsqueciASenha.php");
    }
  ?>


<?php
session_start();
require "../includes/dados-conexao.inc.php";
require "../includes/conectar.inc.php";
require "../includes/abrir-banco.inc.php";
require "../includes/definir-charset.inc.php";

// Verifica se o formulário de login foi submetido
if (isset($_POST["login"])) {
    // Verifica se houve erro na conexão
    if ($conexao->connect_error) {
        die("Conexão falhou: " . $conexao->connect_error);
    }

    // Escapa os caracteres especiais para evitar injeção de SQL
    $email = $conexao->real_escape_string($_POST['login']);
    $senha = $conexao->real_escape_string($_POST['senha']);

    // Consulta SQL para verificar as credenciais do usuário
    $sql = "SELECT senha_hash, email FROM $nomeDaTabela2 WHERE email = '$email' AND senha_hash = '$senha'";

    // Executa a consulta SQL
    $result = $conexao->query($sql) or exit($conexao->error);

    // Verifica se há uma linha correspondente na tabela de usuários
    $vetorRegistro = $resultado->fetch_array();
    $senhaCriptografada = $vetorRegistro[0];
   
    $senhaCorreta = password_verify($senha, $senhaCriptografada);
   
    if($senhaCorreta)
     {
     session_start();
     $_SESSION['conectado'] = true;
     header("location: homeAdmin.php");
     }
   
    else
     {
     echo "<p> Credenciais incorretas. </p>";
     }
        // Verifica se a senha fornecida corresponde ao hash no banco de dados
        if (password_verify($senha, $row['senha_hash'])) {
            // Credenciais válidas, inicia a sessão e redireciona para a página de destino
            $_SESSION["usuario_admin"] = $email;
            header("Location: homeAdmin.php");
            exit();
        }
    }

    // Credenciais inválidas, exibe uma mensagem de erro
    echo "<p>Login ou senha incorretos. Tente novamente.</p>";

    // Fecha a conexão com o banco de dados
    $conexao->close();
?>

</body> 
</html> 
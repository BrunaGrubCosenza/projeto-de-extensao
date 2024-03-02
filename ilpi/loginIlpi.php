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
    <label class="alinha"> Login: </label>
    <input type="text" name="login" autofocus> <br>

    <label class="alinha"> Senha: </label>
    <input type="password" name="senha"> <br>

    <div>
     <button name="logar"> Entrar </button>
     <button name="recover"> Esqueci minha senha </button>
    </div>
   </fieldset>
  </form>

  <?php   
   if(isset($_POST['logar']))
   {
   header("location: ./perfilIlpi.php");
   }
   if(isset($_POST['recover']))
   {
   header("location: ./senhaIlpi.php");
   }
  ?>


<?php
session_start();

// Verifica se o formulário de login foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logar'])) {
    // Detalhes do seu banco de dados ILPISystem
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "usuarios";

    // Cria a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se houve erro na conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Escapa os caracteres especiais para evitar injeção de SQL
    $email = $conn->real_escape_string($_POST['login']);
    $senha = $conn->real_escape_string($_POST['senha']);

    // Consulta SQL para verificar as credenciais do usuário
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";

    // Executa a consulta SQL
    $result = $conn->query($sql);

    // Verifica se há uma linha correspondente na tabela de usuários
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verifica se a senha fornecida corresponde ao hash no banco de dados
        if (password_verify($senha, $row['senha_hash'])) {
            // Credenciais válidas, inicia a sessão e redireciona para a página de destino
            $_SESSION["usuario_ilpi"] = $email;
            header("Location: atualizarDadosIlpi.php");
            exit();
        }
    }

    // Credenciais inválidas, exibe uma mensagem de erro
    echo "<p>Login ou senha incorretos. Tente novamente.</p>";

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>


</body> 
</html> 
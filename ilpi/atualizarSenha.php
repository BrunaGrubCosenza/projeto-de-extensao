<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['conectado']) || $_SESSION['conectado'] !== true || !isset($_SESSION['email'])) {
    // Redirecionar para a página de login se não estiver autenticado
    header("Location: loginIlpi.php");
    exit();
}

// Verificar se o formulário foi submetido
if (isset($_POST['salvarNovaSenha'])) {
    $senha = $_POST['senha'];
    $confirmacaoSenha = $_POST['confirmacaoSenha'];

    // Verificar se as senhas coincidem
    if ($senha !== $confirmacaoSenha) {
        echo "As senhas não coincidem. Tente novamente.";
        exit();
    }

    // Hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Incluir o arquivo de conexão com o banco de dados e executar a atualização
    require "../includes/dados-conexao.inc.php";
    require "../includes/conectar.inc.php";
    require "../includes/abrir-banco.inc.php";
    require "../includes/definir-charset.inc.php";

    $email = $_SESSION['email'];

    // Atualizar a senha na tabela de usuários e definir 'primeiro_acesso' como falso
    $sql = "UPDATE usuarios SET senha_hash = '$senhaHash', primeiro_acesso = 0 WHERE email = '$email'";
    $conexao->query($sql) or exit($conexao->error);

    // Redirecionar o usuário para a página de perfil ou qualquer outra após a atualização da senha
    header("Location: perfilIlpi.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Senha</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <header>
        <img class="img-header" src="../logo.png" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
    </header>
    <h1>Nova senha</h1>
    <form action="atualizarSenha.php" method="post">
        <p>Insira sua nova senha de acesso</p>
        <label class="alinha">Senha</label>
        <input type="password" name="senha" required><br>
        <label class="alinha">Confirmação de senha</label>
        <input type="password" name="confirmacaoSenha" required><br>
        <button class="botoes" name="salvarNovaSenha" type="submit">Salvar</button>
    </form>
</body>
</html>

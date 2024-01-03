<?php
$nomeIlpi = trim($conexao->escape_string($_POST['nome']));
$cnpj = trim($conexao->escape_string($_POST['cnpj']));
$endereco = trim($conexao->escape_string($_POST['endereco']));
$municipio = trim($conexao->escape_string($_POST['municipio']));
$cep = trim($conexao->escape_string($_POST['cep']));
$email = trim($conexao->escape_string($_POST['email']));
$telefone = trim($conexao->escape_string($_POST['telefone']));
$responsavel = trim($conexao->escape_string($_POST['responsavel']));
$qtdTotalVagas = trim($conexao->escape_string($_POST['qtdTotalVagas']));
$qtdVagas = trim($conexao->escape_string($_POST['qtdVagas']));
$checkbox_value1 = trim($conexao->escape_string(isset($_POST['opcao1']) ? 1 : 0));
$checkbox_value2 = trim($conexao->escape_string(isset($_POST['opcao2']) ? 1 : 0));
$checkbox_value3 = trim($conexao->escape_string(isset($_POST['opcao3']) ? 1 : 0));
$checkbox_value4 = trim($conexao->escape_string(isset($_POST['opcao4']) ? 1 : 0));
$equipe = trim($conexao->escape_string($_POST['equipe']));
$estrutura = trim($conexao->escape_string($_POST['estrutura']));
$atvdSemanal = trim($conexao->escape_string($_POST['atvdSemanal']));

//criptografar a senha
$senha = password_hash($senha, PASSWORD_ARGON2I);

//gravamos os dados do usuário no banco
$sql = "INSERT $nomeDaTabela VALUES(
             null,
             '$nome',
             '$email',
             '$login',
             '$senha')";
$conexao->query($sql) or die($conexao->error);

//aqui, também, iniciaremos uma sessão para este usuário
session_start();
$_SESSION['conectado'] = true;

//redirecionamos o usuário para a página restrita
header("location: restrita.php");
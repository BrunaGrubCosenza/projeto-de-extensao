<?php
$cnpjIlpi = trim($conexao->escape_string($_POST['cnpjIlpi']));
$emailUsuario = trim($conexao->escape_string($_POST['emailUsuario']));
$senha = trim($conexao->escape_string($_POST['senha']));
$radioValue = trim($conexao->escape_string(isset($_POST['usuarioAdmin']) && $_POST['usuarioAdmin'] == "Sim" ? 1 : 0));
$senha = password_hash($senha, PASSWORD_ARGON2I);
$sql = "INSERT $nomeDaTabela2 VALUES(
    '$cnpjIlpi',
    '$emailUsuario',
    '$senha',
    '$radioValue')";
$conexao->query($sql) or die($conexao->error);
<?php
$cnpjIlpi = trim($conexao->escape_string($_POST['cnpjIlpi']));
$emailUsuario = trim($conexao->escape_string($_POST['emailUsuario']));
$senha = trim($conexao->escape_string($_POST['senha']));
$radioValue = trim($conexao->escape_string(isset($_POST['usuarioAdmin']) && $_POST['usuarioAdmin'] == "Sim" ? 1 : 0));
$statusUsuario = trim($conexao->escape_string($_POST['statusUsuario']));

$sql = "INSERT $nomeDaTabela2 VALUES(
    '$cnpjIlpi',
    '$emailUsuario',
    '$senha',
    '$radioValue',
    '$statusUsuario')";
$conexao->query($sql) or die($conexao->error);

$sql = "INSERT INTO $nomeDaTabela2 (cnpj_ilpi)
VALUES $nomeDaTabela1 (cnpj)";

//aqui, também, iniciaremos uma sessão para este usuário
session_start();
$_SESSION['conectado'] = true;


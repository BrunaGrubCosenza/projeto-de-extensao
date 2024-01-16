<?php

//colei aqui só para usar de base a include de login do Herval

 $login         = trim($conexao->escape_string($_POST['login']));
 $senha         = trim($conexao->escape_string($_POST['senha']));
 //c:\Users\muril\OneDrive\Documentos\cstgti-prw2\CSTGTI-PRW2\Login\includes\logout.inc.php
 //buscar, no banco de dados, a senha do usuário, usando, como chave de pesquisa, o seu login
 $sql = "SELECT senha FROM $nomeDaTabela WHERE login = '$login'";

 $resultado = $conexao->query($sql) OR die($conexao->error);

 $vetorRegistro = $resultado->fetch_array();
 $senhaCriptografada = $vetorRegistro[0];

 $senhaCorreta = password_verify($senha, $senhaCriptografada);

 if($senhaCorreta)
  {
  session_start();
  $_SESSION['conectado'] = true;
  header("location: restrita.php");
  }

 else
  {
  echo "<p> Credenciais incorretas. </p>";
  }
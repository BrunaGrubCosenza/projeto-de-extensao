<?php
 session_start();
 //esta include testa se o usuário passou pelo cadastro ou pelo login antes de exibirmos o conteúdo restrito 

 if(!isset($_SESSION["conectado"]) OR $_SESSION["conectado"] != true)
  {
  exit("<p> Acesso proibido. <a href='../direcionamentoLogin.php'> Clique aqui para fazer o login! </a></p>");
  }
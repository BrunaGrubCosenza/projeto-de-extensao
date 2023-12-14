<?php
 //esta etapa é opcional. Se o banco já está criado no servidor, esta include é desnecessária
 $sql = "CREATE DATABASE IF NOT EXISTS $nomeDoBanco";
 $conexao->query($sql) or die($conexao->error);
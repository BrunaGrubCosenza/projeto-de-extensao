<?php
 //o comando abaixo estabelece, de fato, a comunicação entre o nosso código em PHP eo SGBD MySQL
 $conexao = new mysqli($servidor, $usuario, $senha);
 mysqli_select_db($conexao, "ILPISystem");
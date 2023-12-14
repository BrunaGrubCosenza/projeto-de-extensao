<?php
 $sql = "CREATE TABLE IF NOT EXISTS $nomeDaTabela(
            ID INT PRIMARY KEY AUTO_INCREMENT,
            nome VARCHAR(500),
            email VARCHAR(300),
            login VARCHAR(300),
            senha VARCHAR(128)
            ) ENGINE=innoDB";


//observe o tamanho do campo senha no banco de dados. O valor mínimo é 128 caracteres. Este campo armazenará a senha criptografada pelo PHP. O algoritmo que iremos usar sempre gera um hash alfanumérico hexadecimal de 128 caracteres

 $conexao->query($sql) or die($conexao->error);

<!DOCTYPE html> 
<html lang="pt-BR"> 
<head> 
  <meta charset="utf-8"> 
  <title> Dados das ILPIs </title> 
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head> 

<body>
  <header>
    <img class="img-header" src="../logo.png" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
    <nav class="nav-header">
    <a href="homeAdmin.php"><i class="fa-solid fa-house"></i></a>
  </nav>
  </header> 

  <h1> Dados Gerais </h1>
  
    <?php
    require "../includes/dados-conexao.inc.php";
    require "../includes/conectar.inc.php";

    $sql = "SELECT * FROM $nomeDaTabela1";
    $result = $conexao->query($sql);

    // Exibir os resultados em uma tabela HTML
        if ($result->num_rows > 0) {
        echo "<table> <tr>
        <th>Nome</th>
        <th>CNPJ</th>
        <th>Município</th>
        <th>Capacidade de Acolhimento</th>
        <th>Vagas Disponíveis</th>    
        <th>Convênios</th>
    </tr>";
        while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>".$row['nome']."</td>";
          echo "<td>".$row['cnpj']."</td>";
          echo "<td>".$row['municipio']."</td>";
          echo "<td>".$row['capacidade_acolhimento']."</td>";
          echo "<td>".$row['vagas']."</td>";
          echo "<td>".$row['privada']." - " .$row['filantropica']." - " .$row['convenio_publico_estadual']." - " .$row['convenio_publico_municipal']. "</td>";
          echo "</tr>";
    }
        echo "</table>";
    } else {
    echo "<p>0 resultados</p>";
    }
    ?>
</body> 
</html> 
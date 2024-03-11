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
  <table>
    <tr>
        <th>Nome</th>
        <th>CNPJ</th>
        <th>Município</th>
        <th>Capacidade de Acolhimento</th>
        <th>Vagas Disponíveis</th>    
        <th>Convênios</th>
    </tr>
    <?php
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".$row['nome']."</td>";
        echo "<td>".$row['CNPJ']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "</tr>";
    }
    
    $sql = "SELECT * FROM nome_da_tabela";
    $result = $conn->query($sql);

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
          echo "<td>".$row['nomeIlpi']."</td>";
          echo "<td>".$row['cnpj']."</td>";
          echo "<td>".$row['municipio']."</td>";
          echo "<td>".$row['capacidadeAcolhimento']."</td>";
          echo "<td>".$row['vagas']."</td>";
          echo "<td>".$row['checkboxValue1']." - " .$row['checkboxValue2']." - " .$row['checkboxValue3']." - " .$row['checkboxValue4']. "</td>";
          echo "</tr>";
    }
        echo "</table>";
    } else {
    echo "0 resultados";
    }
    ?>
</body> 
</html> 
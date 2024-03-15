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

  <section class="section-dados-gerais">
  <h1 class='h1-estilizado'> Dados Gerais </h1>
  
    <?php
    require "../includes/dados-conexao.inc.php";
    require "../includes/conectar.inc.php";

    $sql = "SELECT * FROM $nomeDaTabela1";
    $result = $conexao->query($sql);

    // Exibir os resultados em uma tabela HTML
        if ($result->num_rows > 0) {
        echo "<table class='tabela-dados-gerais'>
        <thead>
          <tr>
            <th>CNPJ</th>
            <th>Nome</th>
            <th>Município</th>
            <th>Capacidade de Acolhimento</th>
            <th>Vagas Disponíveis</th>    
            <th>Convênios</th>
          </tr>
        </thead>
        <tbody>";
        while($row = $result->fetch_assoc()) {
          $cnpj_ilpi = $row['cnpj'];
          echo "<tr>";
          echo "<td> <a class='link-tabela-dados-gerais' href='../ilpi/perfilIlpi.php?cnpj_ilpi=$cnpj_ilpi'> {$row['cnpj']} </a> </td>";
          echo "<td> <a class='link-tabela-dados-gerais' href='../ilpi/perfilIlpi.php?cnpj_ilpi=$cnpj_ilpi'> {$row['nome']} </a> </td>";
          echo "<td>".$row['municipio']."</td>";
          echo "<td>".$row['capacidade_acolhimento']."</td>";
          echo "<td>".$row['vagas']."</td>";
          echo "<td>";
          echo $row['privada'] == 1 ? '-Privada<br>' : '';
          echo $row['filantropica'] == 1 ? '-Filantrópica<br>' : '';
          echo $row['convenio_publico_estadual'] == 1 ? '-Convênio Estadual<br>' : '';
          echo $row['convenio_publico_municipal'] == 1 ? '-Convênio Municipal<br>' : '';
          if ($row['privada'] != 1 && $row['filantropica'] != 1 && $row['convenio_publico_estadual'] != 1 && $row['convenio_publico_municipal'] != 1) {
            echo "Não há convênios";
          }
          echo "</td>";
          echo "</tr>";
        }
        echo "</tbody>
              </table>";
    } else {
    echo "<p>0 resultados</p>";
    }
    ?>
    </section>
</body> 
</html> 
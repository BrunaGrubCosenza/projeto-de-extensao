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

  <section class="filtros">

    <div title="Buscar ILPI por nome ou CNPJ">
      <label for="filtro"><i class="fas fa-search"></i> </label>
      <input type="text" id="filtro" placeholder="Buscar por nome ou CNPJ" oninput="filtrarPorNomeOuCNPJ()">
    </div>

    <div class="select-container" title="Filtrar por município">
      <span>Município:</span> <br>
      <label for="municipio"> 
        <i class="fas fa-city"></i> 
        <select id="municipio">
          <option value="todos" selected>Todos</option>
          <?php
          require "../includes/dados-conexao.inc.php";
          require "../includes/conectar.inc.php";
          $sql = "SELECT DISTINCT municipio FROM $nomeDaTabela1";
          $result = $conexao->query($sql);
          $municipios = array(); 
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  $municipios[] = $row['municipio']; 
              }
          }
          usort($municipios, function($a, $b) {
            return strcasecmp($a, $b);
        });
          foreach ($municipios as $municipio) {
              echo "<option value='$municipio'>$municipio</option>";
          }
          ?>
        </select>
      </label>
    </div>
      
    <div class="select-container" title="Filtrar por convênio">
      <span>Convênio:</span> <br>
      <label for="convenio">
        <i class="fas fa-handshake"></i>  
        <select id="convenio">
          <option value="todos" selected>Todos</option>
          <option value="privada">Privada</option>
          <option value="filantropica">Filantrópica</option>
          <option value="convenio_publico_estadual">Convênio Estadual</option>
          <option value="convenio_publico_municipal">Convênio Municipal</option>
          <option value="sem_convenio">Sem Convênio</option>
        </select>
      </label>
    </div>

      <!-- Botão para Ordenar por Vagas Disponíveis -->
    <button id="ordenarVagas">Ordenar por vagas</button>
  </section>

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
            <th style='text-align: center'>Capacidade de Acolhimento</th>
            <th style='text-align: center'>Vagas Disponíveis</th>    
            <th>Convênios</th>
          </tr>
        </thead>
        <tbody>";
        while($row = $result->fetch_assoc()) {
          $cnpj_ilpi = $row['cnpj'];
          echo "<tr>";
          echo "<td> <div style='width: 120px' class='link-tabela-dados-gerais'> <a href='../ilpi/perfilIlpi.php?cnpj_ilpi=$cnpj_ilpi'> {$row['cnpj']} </a> </div> </td>";
          echo "<td> <div style='width: 180px' class='link-tabela-dados-gerais'> <a href='../ilpi/perfilIlpi.php?cnpj_ilpi=$cnpj_ilpi'> {$row['nome']} </a> </div> </td>";
          echo "<td>".$row['municipio']."</td>";
          echo "<td style='text-align: center'>".$row['capacidade_acolhimento']."</td>";
          echo "<td style='text-align: center'>".$row['vagas']."</td>";
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
    <script>
  document.getElementById('ordenarVagas').addEventListener('click', function() {
    var linhas = Array.from(document.querySelectorAll('.tabela-dados-gerais tbody tr'));
    
    linhas.sort(function(a, b) {
      var vagasA = parseInt(a.querySelector('td:nth-child(5)').textContent);
      var vagasB = parseInt(b.querySelector('td:nth-child(5)').textContent);
      return vagasB - vagasA;
    });

    var tbody = document.querySelector('.tabela-dados-gerais tbody');
    tbody.innerHTML = '';
    linhas.forEach(function(linha) {
      tbody.appendChild(linha);
    });
  });

  function filtrarConvenio() {
    var filtrosSelecionados = Array.from(document.getElementById('convenio').selectedOptions).map(option => option.value);
    var filtroMunicipio = removerAcentos(document.getElementById('municipio').value.toLowerCase());

    var linhas = Array.from(document.querySelectorAll('.tabela-dados-gerais tbody tr'));

    linhas.forEach(function(linha) {
      var convenios = linha.querySelector('td:nth-child(6)').innerHTML;

      var mostrarPorConvenio = filtrosSelecionados.includes('todos') || filtrosSelecionados.some(function(filtro) {
        if (filtro === 'sem_convenio') {
          return convenios === 'Não há convênios';
        } else if (filtro === 'privada') {
          return convenios.includes('-Privada');
        } else if (filtro === 'filantropica') {
          return convenios.includes('-Filantrópica');
        } else if (filtro === 'convenio_publico_estadual') {
          return convenios.includes('-Convênio Estadual');
        } else if (filtro === 'convenio_publico_municipal') {
          return convenios.includes('-Convênio Municipal');
        }
      });

      var municipio = removerAcentos(linha.querySelector('td:nth-child(3)').textContent.trim().toLowerCase());
      var mostrarPorMunicipio = (filtroMunicipio === 'todos' || municipio === filtroMunicipio);

      linha.style.display = mostrarPorConvenio && mostrarPorMunicipio ? '' : 'none';
    });
  }

  //Município
  function removerAcentos(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  }

  document.getElementById('municipio').addEventListener('change', function() {
    var filtroSelecionado = removerAcentos(this.value.toLowerCase()); // Converter para minúsculas e remover acentos
    var linhas = Array.from(document.querySelectorAll('.tabela-dados-gerais tbody tr'));

    linhas.forEach(function(linha) {
      var municipio = removerAcentos(linha.querySelector('td:nth-child(3)').textContent.trim().toLowerCase()); // Converter para minúsculas e remover acentos
      var mostrarLinha = (filtroSelecionado === 'todos' || municipio === filtroSelecionado);
      linha.style.display = mostrarLinha ? '' : 'none';
    });

    // Resetar o filtro de convênio para "Todos"
    document.getElementById('convenio').value = 'todos';

    // Filtrar novamente após a mudança no município
    filtrarConvenio();
  });

  document.getElementById('convenio').addEventListener('change', function() {
    filtrarConvenio();
  });

  function filtrarPorNomeOuCNPJ() {
    // Definir filtros de convênio e município como "todos"
    document.getElementById('convenio').value = 'todos';
    document.getElementById('municipio').value = 'todos';

    var filtro = document.getElementById('filtro').value.trim().toLowerCase();
    var linhas = Array.from(document.querySelectorAll('.tabela-dados-gerais tbody tr'));

    linhas.forEach(function(linha) {
      var nome = linha.querySelector('td:nth-child(2)').textContent.trim().toLowerCase(); // Coluna do nome
      var cnpj = linha.querySelector('td:nth-child(1)').textContent.trim().toLowerCase(); // Coluna do CNPJ

      // Verifica se o nome ou o CNPJ contém o termo de busca
      var mostrarLinha = nome.includes(filtro) || cnpj.includes(filtro);

      // Exibe ou oculta a linha com base no filtro
      linha.style.display = mostrarLinha ? '' : 'none';
    });
  }
</script>

  </section>
</body> 
</html> 
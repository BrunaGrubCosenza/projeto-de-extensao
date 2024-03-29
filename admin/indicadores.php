<!DOCTYPE html> 
<html lang="pt-BR"> 
<head> 
  <meta charset="utf-8"> 
  <title> Indicadores </title> 
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Adicione o CSS e o JS do Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <style>
    #map {
      height: 400px;
    }
  </style>
</head> 

<body>
  <header>
    <img class="img-header" src="../logo.png" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
    <nav class="nav-header">
    <a href="homeAdmin.php"><i class="fa-solid fa-house"></i></a>
  </nav>
  </header> 

  <h1> Indicadores </h1>

  <!-- Div para envolver o mapa e os gráficos -->
<div class="container">
  <!-- Div para o mapa -->
  <div id="map"></div>

  <!-- Div para os gráficos -->
  <div class="container-graficos">
    <!-- Div para o gráfico de torta -->
    <div class="grafico">
      <canvas id="pie-chart"></canvas>
    </div>

    <!-- Div para o gráfico de barras -->
    <div class="grafico">
      <canvas id="bar-chart"></canvas>
    </div>
  </div>
</div>

  <?php
  // Inclua o arquivo de conexão com o banco de dados
  require "../includes/dados-conexao.inc.php";
  require "../includes/conectar.inc.php";
  require "../includes/abrir-banco.inc.php";
  require "../includes/definir-charset.inc.php";

  // Consulta SQL para somar as capacidades de acolhimento
  $sql_capacidade = "SELECT SUM(capacidade_acolhimento) AS total_capacidade FROM $nomeDaTabela1";
  $resultado_capacidade = $conexao->query($sql_capacidade);
  $total_capacidade = $resultado_capacidade->fetch_assoc()['total_capacidade'];

  // Consulta SQL para somar as vagas disponíveis
  $sql_vagas = "SELECT SUM(vagas) AS total_vagas FROM $nomeDaTabela1";
  $resultado_vagas = $conexao->query($sql_vagas);
  $total_vagas = $resultado_vagas->fetch_assoc()['total_vagas'];

  // Calcular a porcentagem de vagas disponíveis
  $porcentagem_vagas_disponiveis = ($total_vagas / $total_capacidade) * 100;
  ?>

  <!-- Script para criar o gráfico de torta -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  // Obtenha o elemento de canvas para o gráfico de torta
  var ctxPie = document.getElementById('pie-chart').getContext('2d');

  // Dados do gráfico de torta
  var dataPie = {
      labels: ['Vagas Disponíveis', 'Ocupadas'],
      datasets: [{
          data: [<?php echo $porcentagem_vagas_disponiveis; ?>, <?php echo 100 - $porcentagem_vagas_disponiveis; ?>],
          backgroundColor: [
              'green',
              'red'
          ]
      }]
  };

  // Opções do gráfico de torta
  var optionsPie = {
      title: {
          display: true,
          text: 'Porcentagem de Vagas Disponíveis'
      }
  };

  // Crie o gráfico de torta
  var pieChart = new Chart(ctxPie, {
      type: 'pie',
      data: dataPie,
      options: optionsPie
  });
  </script>

  <?php
  // Consulta SQL para obter a quantidade de vagas por município
  $sql_municipio_vagas = "SELECT municipio, SUM(vagas) AS total_vagas FROM $nomeDaTabela1 GROUP BY municipio";
  $resultado_municipio_vagas = $conexao->query($sql_municipio_vagas);

  // Arrays para armazenar os dados do gráfico de barras
  $labels = [];
  $data = [];

  // Loop através dos resultados da consulta
  while ($row = $resultado_municipio_vagas->fetch_assoc()) {
      $labels[] = $row['municipio'];
      $data[] = $row['total_vagas'];
  }
  ?>

  <!-- Script para criar o gráfico de barras -->
  <script>
  // Obtenha o elemento de canvas para o gráfico de barras
  var ctxBar = document.getElementById('bar-chart').getContext('2d');

  // Dados do gráfico de barras
  var dataBar = {
      labels: <?php echo json_encode($labels); ?>,
      datasets: [{
          label: 'Quantidade de Vagas Disponíveis por Município',
          data: <?php echo json_encode($data); ?>,
          backgroundColor: 'blue'
      }]
  };

  // Opções do gráfico de barras
  var optionsBar = {
      scales: {
          y: {
              beginAtZero: true,
              title: {
                  display: true,
                  text: 'Quantidade de Vagas Disponíveis'
              }
          },
          x: {
              title: {
                  display: true,
                  text: 'Município'
              }
          }
      }
  };

  // Crie o gráfico de barras
  var barChart = new Chart(ctxBar, {
      type: 'bar',
      data: dataBar,
      options: optionsBar
  });
  </script>

  <!-- Script para criar o mapa de Santa Catarina -->
  <script>
  var map = L.map('map').setView([-27.5953778, -48.5480499], 7); // Centraliza o mapa em Santa Catarina

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { // Adiciona um layer de azulejos do OpenStreetMap
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Função para formatar números com separador de milhares
  function formatNumber(number) {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  // Consulta SQL para obter a quantidade de vagas em Florianópolis
  <?php
  $sql_florianopolis_vagas = "SELECT SUM(vagas) AS total_vagas FROM $nomeDaTabela1 WHERE municipio = 'Florianópolis'";
  $resultado_florianopolis_vagas = $conexao->query($sql_florianopolis_vagas);
  $total_florianopolis_vagas = $resultado_florianopolis_vagas->fetch_assoc()['total_vagas'];
  ?>

  // Adiciona um marcador em Florianópolis
  var marker = L.marker([-27.5953778, -48.5480499]).addTo(map);
  // Adiciona uma pop-up ao marcador com a quantidade de vagas disponíveis em Florianópolis
  marker.bindPopup(formatNumber(<?php echo $total_florianopolis_vagas; ?>) + " vagas disponíveis").openPopup();

  // Consulta SQL para obter a quantidade de vagas em São José
  <?php
  $sql_sao_jose_vagas = "SELECT SUM(vagas) AS total_vagas FROM $nomeDaTabela1 WHERE municipio = 'São José'";
  $resultado_sao_jose_vagas = $conexao->query($sql_sao_jose_vagas);
  $total_sao_jose_vagas = $resultado_sao_jose_vagas->fetch_assoc()['total_vagas'];
  ?>

  // Adiciona um marcador em São José
  var markerSaoJose = L.marker([-27.6136, -48.6367]).addTo(map);
  // Adiciona uma pop-up ao marcador com a quantidade de vagas disponíveis em São José
  markerSaoJose.bindPopup(formatNumber(<?php echo $total_sao_jose_vagas; ?>) + " vagas disponíveis").openPopup();
  </script>

</body>
</html>

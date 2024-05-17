<?php
require_once "../includes/valida-acesso-admin.inc.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Indicadores </title>
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Adicione o CSS e o JS do Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>

<body>
  <header>
    <img class="img-header" src="../logo.png"
      alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
    <nav class="nav-header">
      <a href="homeAdmin.php"><i class="fa-solid fa-house"></i></a>
    </nav>
  </header>

  <h1 class="h1-estilizado" style="font-size: 31px;"> Indicadores </h1>


  <div class="container-indicadores">    
    <div class="container-mapa">
      <h1 class="h1-estilizado" style="font-size: 22px;"> Mapa de vagas disponíveis por município </h1>
      <div class="container-map">
        <div id="map"></div>
      </div>
    </div>
    
    <div class="container-grafico">
      <h1 class="h1-estilizado" style="font-size: 22px;"> Gráfico de porcentagem de vagas no estado </h1>
        <div class="grafico">
          <canvas id="pie-chart"></canvas>
        </div>
    </div>
  </div>


  <?php
  // Definir matriz de coordenadas
  $coordenadas_sc = array(
    "Abdon Batista" => array(-27.6123, -51.0232),
    "Abelardo Luz" => array(-26.5659, -52.3229),
    "Agrolândia" => array(-27.4085, -49.8228),
    "Agronômica" => array(-27.2666, -49.7086),
    "Água Doce" => array(-26.9981, -51.5526),
    "Águas de Chapecó" => array(-27.0754, -52.9814),
    "Águas Frias" => array(-26.8794, -52.8702),
    "Águas Mornas" => array(-27.6967, -48.8237),
    "Alfredo Wagner" => array(-27.7099, -49.3278),
    "Alto Bela Vista" => array(-27.4333, -51.9045),
    "Anchieta" => array(-26.8483, -53.3319),
    "Angelina" => array(-27.5706, -48.9875),
    "Anita Garibaldi" => array(-27.6903, -51.1273),
    "Anitápolis" => array(-27.9014, -49.1314),
    "Antônio Carlos" => array(-27.5253, -48.7663),
    "Apiúna" => array(-27.0373, -49.3881),
    "Arabutã" => array(-27.1583, -52.1422),
    "Araquari" => array(-26.3777, -48.7182),
    "Araranguá" => array(-28.9381, -49.486),
    "Armazém" => array(-28.2446, -49.0168),
    "Arroio Trinta" => array(-26.9256, -51.3407),
    "Arvoredo" => array(-27.1769, -52.4846),
    "Ascurra" => array(-26.9548, -49.3835),
    "Atalanta" => array(-27.4219, -49.7789),
    "Aurora" => array(-27.3098, -49.6422),
    "Balneário Arroio do Silva" => array(-28.9806, -49.4237),
    "Balneário Barra do Sul" => array(-26.4597, -48.6129),
    "Balneário Camboriú" => array(-26.9922, -48.6352),
    "Balneário Gaivota" => array(-29.2519, -49.7264),
    "Balneário Piçarras" => array(-26.7639, -48.6692),
    "Balneário Rincão" => array(-28.8456, -49.2351),
    "Bandeirante" => array(-26.7708, -53.6419),
    "Barra Bonita" => array(-27.0747, -53.0634),
    "Barra Velha" => array(-26.637, -48.6935),
    "Bela Vista do Toldo" => array(-26.2742, -50.4662),
    "Belmonte" => array(-26.8434, -53.5759),
    "Benedito Novo" => array(-26.7813, -49.3591),
    "Biguaçu" => array(-27.496, -48.6593),
    "Blumenau" => array(-26.9208, -49.0709),
    "Bocaina do Sul" => array(-27.7122, -49.9422),
    "Bom Jardim da Serra" => array(-28.3421, -49.6378),
    "Bom Jesus" => array(-26.7351, -52.9529),
    "Bom Jesus do Oeste" => array(-26.692, -53.0969),
    "Bom Retiro" => array(-27.798, -49.4875),
    "Bombinhas" => array(-27.1469, -48.4829),
    "Botuverá" => array(-27.2198, -49.0684),
    "Braço do Norte" => array(-28.2706, -49.1704),
    "Braço do Trombudo" => array(-27.3584, -49.7684),
    "Brunópolis" => array(-27.3067, -51.0297),
    "Brusque" => array(-27.0977, -48.9106),
    "Caçador" => array(-26.7757, -51.0126),
    "Caibi" => array(-27.0742, -53.2455),
    "Calmon" => array(-26.5942, -51.095),
    "Camboriú" => array(-27.027, -48.6509),
    "Campo Alegre" => array(-26.1943, -49.2456),
    "Campo Belo do Sul" => array(-27.8985, -50.7597),
    "Campo Erê" => array(-26.6421, -53.0852),
    "Campos Novos" => array(-27.4038, -51.2214),
    "Canelinha" => array(-27.2603, -48.7657),
    "Canoinhas" => array(-26.1766, -50.3945),
    "Capão Alto" => array(-27.9388, -50.5095),
    "Capinzal" => array(-27.3479, -51.6059),
    "Capivari de Baixo" => array(-28.4638, -48.9651),
    "Catanduvas" => array(-27.0728, -51.6604),
    "Caxambu do Sul" => array(-27.1628, -52.8802),
    "Celso Ramos" => array(-27.6328, -51.3359),
    "Cerro Negro" => array(-27.7949, -50.8673),
    "Chapadão do Lageado" => array(-27.5905, -49.5531),
    "Chapecó" => array(-27.1004, -52.6152),
    "Cocal do Sul" => array(-28.5983, -49.3335),
    "Concórdia" => array(-27.2335, -52.0261),
    "Cordilheira Alta" => array(-26.9844, -52.6053),
    "Coronel Freitas" => array(-26.9057, -52.7014),
    "Coronel Martins" => array(-26.511, -52.6694),
    "Correia Pinto" => array(-27.5877, -50.3611),
    "Corupá" => array(-26.4246, -49.2469),
    "Criciúma" => array(-28.6722, -49.3729),
    "Cunha Porã" => array(-26.895, -53.1669),
    "Cunhataí" => array(-26.9709, -53.0891),
    "Curitibanos" => array(-27.2824, -50.5816),
    "Descanso" => array(-26.827, -53.5037),
    "Dionísio Cerqueira" => array(-26.2648, -53.6354),
    "Dona Emma" => array(-26.9811, -49.7269),
    "Doutor Pedrinho" => array(-26.7174, -49.4791),
    "Entre Rios" => array(-26.722, -52.5589),
    "Ermo" => array(-28.9865, -49.6436),
    "Erval Velho" => array(-27.2743, -51.4439),
    "Faxinal dos Guedes" => array(-26.8451, -52.2597),
    "Flor do Sertão" => array(-26.7814, -53.3506),
    "Florianópolis" => array(-27.5949, -48.5482),
    "Formosa do Sul" => array(-26.6459, -52.7943),
    "Forquilhinha" => array(-28.7451, -49.478),
    "Fraiburgo" => array(-27.0346, -50.92),
    "Frei Rogério" => array(-27.175, -50.8078),
    "Galvão" => array(-26.4541, -52.6876),
    "Garopaba" => array(-28.0275, -48.6194),
    "Garuva" => array(-26.0306, -48.8526),
    "Gaspar" => array(-26.9336, -48.9533),
    "Governador Celso Ramos" => array(-27.317, -48.5571),
    "Grão Pará" => array(-28.1801, -49.2255),
    "Gravatal" => array(-28.3214, -49.0427),
    "Guabiruba" => array(-27.0808, -48.9808),
    "Guaraciaba" => array(-26.6044, -53.5249),
    "Guaramirim" => array(-26.4688, -49.0026),
    "Guarujá do Sul" => array(-26.3856, -53.5282),
    "Guatambú" => array(-27.1341, -52.7884),
    "Herval d'Oeste" => array(-27.1904, -51.4912),
    "Ibiam" => array(-27.1848, -51.2357),
    "Ibicaré" => array(-27.0889, -51.3688),
    "Ibirama" => array(-27.0547, -49.5192),
    "Içara" => array(-28.7132, -49.3064),
    "Ilhota" => array(-26.9023, -48.8267),
    "Imaruí" => array(-28.3339, -48.8179),
    "Imbituba" => array(-28.2284, -48.6658),
    "Imbuia" => array(-27.4908, -49.4218),
    "Indaial" => array(-26.8991, -49.2354),
    "Iomerê" => array(-27.0019, -51.2449),
    "Ipira" => array(-27.4038, -51.7751),
    "Iporã do Oeste" => array(-26.9854, -53.5356),
    "Ipuaçu" => array(-26.635, -52.4551),
    "Ipumirim" => array(-27.0772, -52.1288),
    "Iraceminha" => array(-26.8216, -53.2768),
    "Irani" => array(-27.0287, -51.9016),
    "Irati" => array(-26.6539, -52.8955),
    "Irineópolis" => array(-26.244, -50.7955),
    "Itá" => array(-27.2902, -52.3212),
    "Itaiópolis" => array(-26.3395, -49.909),
    "Itajaí" => array(-26.9101, -48.6705),
    "Itapema" => array(-27.0985, -48.6112),
    "Itapiranga" => array(-27.1659, -53.7163),
    "Itapoá" => array(-26.1197, -48.6136),
    "Ituporanga" => array(-27.4101, -49.5962),
    "Jaborá" => array(-27.1782, -51.7274),
    "Jacinto Machado" => array(-28.9961, -49.763),
    "Jaguaruna" => array(-28.6176, -49.0294),
    "Jaraguá do Sul" => array(-26.4851, -49.0713),
    "Jardinópolis" => array(-26.7265, -52.8622),
    "Joaçaba" => array(-27.1721, -51.5102),
    "Joinville" => array(-26.3045, -48.8487),
    "José Boiteux" => array(-26.9564, -49.6288),
    "Jupiá" => array(-26.3959, -52.7296),
    "Lacerdópolis" => array(-27.2574, -51.5575),
    "Lages" => array(-27.815, -50.3259),
    "Laguna" => array(-28.4843, -48.7772),
    "Lajeado Grande" => array(-26.8576, -52.5641),
    "Laurentino" => array(-27.2173, -49.7332),
    "Lauro Muller" => array(-28.3859, -49.4032),
    "Lebon Régis" => array(-26.928, -50.6929),
    "Leoberto Leal" => array(-27.5081, -49.2787),
    "Lindóia do Sul" => array(-27.0466, -52.0692),
    "Lontras" => array(-27.1684, -49.5351),
    "Luiz Alves" => array(-26.7155, -48.9325),
    "Luzerna" => array(-27.1304, -51.4686),
    "Macieira" => array(-26.8553, -51.3705),
    "Mafra" => array(-26.1159, -49.8023),
    "Major Gercino" => array(-27.4192, -48.9489),
    "Major Vieira" => array(-26.3709, -50.3261),
    "Maracajá" => array(-28.8466, -49.4607),
    "Maravilha" => array(-26.7665, -53.1738),
    "Marema" => array(-26.8024, -52.6265),
    "Massaranduba" => array(-26.6109, -49.0046),
    "Matos Costa" => array(-26.4709, -51.1501),
    "Meleiro" => array(-28.8245, -49.6375),
    "Mirim Doce" => array(-27.197, -50.0785),
    "Modelo" => array(-26.7727, -53.0347),
    "Mondaí" => array(-27.1008, -53.4032),
    "Monte Carlo" => array(-27.2198, -51.5042),
    "Monte Castelo" => array(-26.461, -50.2329),
    "Morro da Fumaça" => array(-28.6511, -49.216),
    "Morro Grande" => array(-28.8002, -49.7215),
    "Navegantes" => array(-26.8946, -48.6546),
    "Nova Erechim" => array(-26.8982, -52.9063),
    "Nova Itaberaba" => array(-26.9428, -52.814),
    "Nova Trento" => array(-27.278, -48.9298),
    "Nova Veneza" => array(-28.6338, -49.5058),
    "Novo Horizonte" => array(-26.4412, -52.8284),
    "Orleans" => array(-28.3487, -49.2984),
    "Otacílio Costa" => array(-27.4868, -50.1235),
    "Ouro" => array(-27.3379, -51.6199),
    "Ouro Verde" => array(-26.692, -52.3138),
    "Paial" => array(-27.2541, -52.4977),
    "Painel" => array(-27.9234, -50.0972),
    "Palhoça" => array(-27.6455, -48.6699),
    "Palma Sola" => array(-26.3474, -53.2779),
    "Palmeira" => array(-27.6126, -50.1575),
    "Palmitos" => array(-27.0702, -53.1584),
    "Papanduva" => array(-26.3777, -50.1418),
    "Paraíso" => array(-26.62, -53.6718),
    "Passo de Torres" => array(-29.3099, -49.7225),
    "Passos Maia" => array(-26.7829, -52.0563),
    "Paulo Lopes" => array(-27.9607, -48.6862),
    "Pedras Grandes" => array(-28.4339, -49.1949),
    "Penha" => array(-26.7754, -48.6465),
    "Peritiba" => array(-27.3755, -51.9017),
    "Petrolândia" => array(-27.5345, -49.6937),
    "Pinhalzinho" => array(-26.8495, -52.9914),
    "Pinheiro Preto" => array(-27.0484, -51.2243),
    "Piratuba" => array(-27.4244, -51.7729),
    "Planalto Alegre" => array(-27.0708, -52.8674),
    "Pomerode" => array(-26.7387, -49.1779),
    "Ponte Alta" => array(-27.4835, -50.3763),
    "Ponte Alta do Norte" => array(-27.1591, -50.4658),
    "Ponte Serrada" => array(-26.8731, -52.011),
    "Porto Belo" => array(-27.1571, -48.5488),
    "Porto União" => array(-26.2384, -51.0756),
    "Pouso Redondo" => array(-27.2567, -49.9307),
    "Praia Grande" => array(-29.1916, -49.952),
    "Presidente Castello Branco" => array(-27.2216, -51.8082),
    "Presidente Getúlio" => array(-27.0474, -49.6243),
    "Presidente Nereu" => array(-27.2768, -49.3885),
    "Princesa" => array(-26.4444, -53.5995),
    "Quilombo" => array(-26.7264, -52.7247),
    "Rancho Queimado" => array(-27.6726, -49.0193),
    "Rio das Antas" => array(-26.8945, -51.0677),
    "Rio do Campo" => array(-26.9452, -50.1364),
    "Rio do Oeste" => array(-27.1957, -49.7983),
    "Rio do Sul" => array(-27.212, -49.643),
    "Rio dos Cedros" => array(-26.7398, -49.2728),
    "Rio Fortuna" => array(-28.1372, -49.1066),
    "Rio Negrinho" => array(-26.2591, -49.517),
    "Rio Rufino" => array(-27.8595, -49.7757),
    "Riqueza" => array(-27.0652, -53.3267),
    "Rodeio" => array(-26.9243, -49.3647),
    "Romelândia" => array(-26.6804, -53.3178),
    "Salete" => array(-26.9798, -49.9941),
    "Saltinho" => array(-26.6042, -53.0578),
    "Salto Veloso" => array(-26.903, -51.4048),
    "Sangão" => array(-28.6326, -49.1324),
    "Santa Cecília" => array(-26.959, -50.4255),
    "Santa Helena" => array(-26.937, -53.6217),
    "Santa Rosa de Lima" => array(-28.0331, -49.133),
    "Santa Rosa do Sul" => array(-29.1313, -49.7109),
    "Santa Terezinha" => array(-26.7816, -50.0099),
    "Santa Terezinha do Progresso" => array(-26.624, -53.1993),
    "Santiago do Sul" => array(-26.6236, -52.6796),
    "Santo Amaro da Imperatriz" => array(-27.6853, -48.7817),
    "São Bento do Sul" => array(-26.2495, -49.3831),
    "São Bernardino" => array(-26.4739, -52.9685),
    "São Bonifácio" => array(-27.9009, -48.9324),
    "São Carlos" => array(-27.0798, -53.0042),
    "São Cristovão do Sul" => array(-27.2666, -50.4388),
    "São Domingos" => array(-26.5334, -52.8531),
    "São Francisco do Sul" => array(-26.2579, -48.6344),
    "São João Batista" => array(-27.278, -48.8477),
    "São João do Itaperiú" => array(-26.6213, -48.7682),
    "São João do Oeste" => array(-27.0983, -53.5975),
    "São João do Sul" => array(-29.2154, -49.8095),
    "São Joaquim" => array(-28.2893, -49.9458),
    "São José" => array(-27.6136, -48.6366),
    "São José do Cedro" => array(-26.4561, -53.4954),
    "São José do Cerrito" => array(-27.6602, -50.5737),
    "São Lourenço do Oeste" => array(-26.3557, -52.8491),
    "São Ludgero" => array(-28.3133, -49.1806),
    "São Martinho" => array(-28.1609, -48.9864),
    "São Miguel da Boa Vista" => array(-26.6876, -53.2513),
    "São Miguel do Oeste" => array(-26.7221, -53.5172),
    "São Pedro de Alcântara" => array(-27.5665, -48.8042),
    "Saudades" => array(-26.9317, -53.0024),
    "Schroeder" => array(-26.4227, -49.0748),
    "Seara" => array(-27.1564, -52.2991),
    "Serra Alta" => array(-26.7229, -53.0404),
    "Siderópolis" => array(-28.5953, -49.4319),
    "Sombrio" => array(-29.1089, -49.6323),
    "Sul Brasil" => array(-26.7351, -52.964),
    "Taió" => array(-27.1215, -49.9941),
    "Tangará" => array(-27.0996, -51.2479),
    "Tigrinhos" => array(-26.6876, -53.1548),
    "Tijucas" => array(-27.2354, -48.6321),
    "Timbé do Sul" => array(-28.8287, -49.8427),
    "Timbó" => array(-26.8225, -49.2718),
    "Timbó Grande" => array(-26.6124, -50.6601),
    "Três Barras" => array(-26.1056, -50.319),
    "Treviso" => array(-28.5097, -49.4638),
    "Treze de Maio" => array(-28.5537, -49.1565),
    "Treze Tílias" => array(-27.0026, -51.4083),
    "Trombudo Central" => array(-27.3037, -49.7933),
    "Tubarão" => array(-28.4713, -49.0144),
    "Tunápolis" => array(-26.9681, -53.6215),
    "Turvo" => array(-28.9274, -49.683),
    "União do Oeste" => array(-26.762, -52.8542),
    "Urubici" => array(-28.0156, -49.5925),
    "Urupema" => array(-27.9557, -49.8725),
    "Urussanga" => array(-28.5183, -49.323),
    "Vargeão" => array(-26.8621, -52.1546),
    "Vargem" => array(-27.4869, -50.9728),
    "Vargem Bonita" => array(-27.0055, -51.7404),
    "Vidal Ramos" => array(-27.3886, -49.3591),
    "Videira" => array(-27.0086, -51.1541),
    "Vitor Meireles" => array(-26.8782, -49.832),
    "Witmarsum" => array(-26.9275, -49.7943),
    "Xanxerê" => array(-26.8747, -52.4034),
    "Xavantina" => array(-27.0667, -52.3431),
    "Xaxim" => array(-26.959, -52.5375),
    "Zortéa" => array(-27.4521, -51.5528),
  );

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

  if ($total_capacidade != 0) {
    // Calcular a porcentagem de vagas disponíveis
    $porcentagem_vagas_disponiveis = ($total_vagas / $total_capacidade) * 100;
  } else {

    echo "<p> Nenhum dado cadastrado! </p>";
  }



  // Consulta SQL para obter vagas disponíveis por município
  $sql_vagas_por_municipio = "SELECT municipio, SUM(vagas) AS total_vagas FROM $nomeDaTabela1 GROUP BY municipio";
  $resultado_vagas_por_municipio = $conexao->query($sql_vagas_por_municipio);

 
$coordenadas_sc_normalizado = array();
foreach ($coordenadas_sc as $municipio => $coordenadas) {
    $municipio_normalizado = mb_strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $municipio)); // Normaliza o município
    $coordenadas_sc_normalizado[$municipio_normalizado] = $coordenadas;
}
$dados_mapa = array();
while ($row = $resultado_vagas_por_municipio->fetch_assoc()) {
    $municipio = $row['municipio'];
    $municipio_normalizado = mb_strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $municipio)); // Normaliza o município
    $vagas = $row['total_vagas'];
    if (isset($coordenadas_sc_normalizado[$municipio_normalizado])) {
        $coordenadas = $coordenadas_sc_normalizado[$municipio_normalizado];
        $dados_mapa[] = array(
            'coordenadas' => $coordenadas,
            'municipio' => $municipio,
            'vagas' => $vagas
        );
    }
}



  ?>

  <!-- Script para criar o gráfico de torta -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Obtenha o elemento de canvas para o gráfico de torta
    var ctxPie = document.getElementById('pie-chart').getContext('2d');

    // Dados do gráfico de torta
    var dataPie = {
      labels: ['Vagas Disponíveis (%)', 'Ocupadas (%)'],
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
      },
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var currentValue = dataset.data[tooltipItem.index];
            return currentValue + '%';
          }
        }
      }
    };


    // Crie o gráfico de torta
    var pieChart = new Chart(ctxPie, {
      type: 'pie',
      data: dataPie,
      options: optionsPie
    });
  </script>


  <!-- Script para criar o mapa de Santa Catarina -->
  <script>
    var map = L.map('map', {
      minZoom: 7,
      maxZoom: 13
    }).setView([-27.5953778, -48.5480499], 7); // Centraliza o mapa em Santa Catarina


    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { // Adiciona um layer de azulejos do OpenStreetMap
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Adicione marcadores com informações de vagas disponíveis por município
    <?php foreach ($dados_mapa as $dados): ?>
      var coordenadas = [<?php echo $dados['coordenadas'][0]; ?>, <?php echo $dados['coordenadas'][1]; ?>];
      var municipio = "<?php echo $dados['municipio']; ?>";
      var vagas = "<?php echo $dados['vagas']; ?>";

      L.marker(coordenadas).addTo(map)
        .bindPopup("<b>" + municipio + "</b><br>Vagas disponíveis: " + vagas);
    <?php endforeach; ?>
  </script>
</body>

</html>
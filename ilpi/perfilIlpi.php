<html lang="pt-BR"> 
<head> 
  <meta charset="utf-8"> 
  <title> Perfil ILPI </title> 
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script>
  function editField(fieldId) {
    var field = document.getElementById(fieldId);
    var value = field.innerText.trim();
    
    // Cria um elemento de input
    var input = document.createElement('input');
    input.type = 'text';
    input.value = value;
    
    // Substitui o elemento de texto pelo input
    field.innerHTML = ''; // Limpa o conteúdo do campo
    field.appendChild(input); // Adiciona o input ao campo
    
    // Adiciona um botão de submit ao lado do input
    var submitButton = document.createElement('button');
    submitButton.type = 'button'; // Evita o envio do formulário
    submitButton.innerHTML = '<i class="fas fa-check"></i>';
    submitButton.onclick = function() {
        // Quando o botão é clicado, o valor do input é salvo e o campo é revertido para o elemento de texto original
        field.innerText = input.value;
    };
    field.appendChild(submitButton); // Adiciona o botão ao campo
    
    // Foca no input recém-criado
    input.focus();
  }
  var originalContent; // Variável global para armazenar o conteúdo original

        function editConvenios() {
          var conveniosDiv = document.querySelector('.convenios');
          originalContent = conveniosDiv.innerHTML; // Salva o conteúdo original

          // Criação dos checkboxes para os convênios
          conveniosDiv.innerHTML = '';
          conveniosDiv.innerHTML += '<input type=\"checkbox\" id=\"privado\" name=\"privado\" value=\"privado\">';
          conveniosDiv.innerHTML += '<label for=\"privado\">Privada</label><br>';
          conveniosDiv.innerHTML += '<input type=\"checkbox\" id=\"filantropica\" name=\"filantropica\" value=\"filantropica\">';
          conveniosDiv.innerHTML += '<label for=\"filantropica\">Filantrópica</label><br>';
          conveniosDiv.innerHTML += '<input type=\"checkbox\" id=\"convenio_publico_estadual\" name=\"convenio_publico_estadual\" value=\"convenio_publico_estadual\">';
          conveniosDiv.innerHTML += '<label for=\"convenio_publico_estadual\">Convênio Estadual</label><br>';
          conveniosDiv.innerHTML += '<input type=\"checkbox\" id=\"convenio_publico_municipal\" name=\"convenio_publico_municipal\" value=\"convenio_publico_municipal\">';
          conveniosDiv.innerHTML += '<label for=\"convenio_publico_municipal\">Convênio Municipal</label><br>';

          // Adiciona botões de Salvar e Cancelar
          conveniosDiv.innerHTML += '<button onclick=\"saveConvenios()\">Salvar</button>';
          conveniosDiv.innerHTML += '<button onclick=\"cancelEdit()\">Cancelar</button>';
        }

        function saveConvenios() {
          // Captura os valores dos checkboxes atualizados
          var privadaChecked = document.querySelector('#privado').checked;
          var filantropicaChecked = document.querySelector('#filantropica').checked;
          var convenioEstadualChecked = document.querySelector('#convenio_publico_estadual').checked;
          var convenioMunicipalChecked = document.querySelector('#convenio_publico_municipal').checked;

          // Atualiza o texto exibido com base nos valores dos checkboxes
          var newText = '';
          if (privadaChecked) newText += '-Privada<br>';
          if (filantropicaChecked) newText += '-Filantrópica<br>';
          if (convenioEstadualChecked) newText += '-Convênio Estadual<br>';
          if (convenioMunicipalChecked) newText += '-Convênio Municipal<br>';
          if (!privadaChecked && !filantropicaChecked && !convenioEstadualChecked && !convenioMunicipalChecked) newText += 'Não há convênios';

          // Exibe o novo texto na div
          var conveniosDiv = document.querySelector('.convenios');
          conveniosDiv.innerHTML = newText;
        }

        function cancelEdit() {
          // Restaura o conteúdo original
          var conveniosDiv = document.querySelector('.convenios');
          conveniosDiv.innerHTML = originalContent;
        }
</script>
</head> 
<body>
  <header>
    <img class="img-header" src="../logo.png" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
  </header> 

  <h2> Perfil </h2>

<?php
  require "../includes/dados-conexao.inc.php";
  require "../includes/conectar.inc.php";

  $cnpjAtual = $_GET['cnpj_ilpi'];

  // Consulta SQL para recuperar os dados da ILPI com base no CNPJ
  $sql = "SELECT * FROM $nomeDaTabela1 WHERE cnpj = '$cnpjAtual' ";
  $result = $conexao->query($sql);

  // Exibir os resultados em HTML
        if ($result->num_rows > 0) {
        echo "<div class='perfil-ilpi'>
        <section class='perfil-ilpi-left'>";
        while($row = $result->fetch_assoc()) {

          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>Nome</span> 
            <div class='div-campo'>
              <div id='nome' class='input-perfil'>".$row['nome']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"nome\")'></i>
            </div>
          </div>";

          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>CNPJ</span> 
            <div class='div-campo'>
              <div id='cnpj' class='input-perfil'>".$row['cnpj']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"cnpj\")'></i>
            </div>
          </div>";

          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>Endereço</span> 
            <div class='div-campo'>
              <div id='endereco' class='input-perfil'>".$row['endereco']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"endereco\")'></i>
            </div>
          </div>";

          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>Município</span> 
            <div class='div-campo'>
              <div id='municipio' class='input-perfil'>".$row['municipio']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"municipio\")'></i>
            </div>
          </div>";

          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>CEP</span> 
            <div class='div-campo'>
              <div id='cep' class='input-perfil'>".$row['cep']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"cep\")'></i>
            </div>
          </div>";
          
          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>E-mail</span> 
            <div class='div-campo'>
              <div id='email' class='input-perfil'>".$row['email']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"email\")'></i>
            </div>
          </div>";
          
          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>Telefone</span> 
            <div class='div-campo'>
              <div id='telefone' class='input-perfil'>".$row['telefone']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"telefone\")'></i>
            </div>
          </div>";
          
          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>Responsável</span> 
            <div class='div-campo'>
              <div id='responsavel' class='input-perfil'>".$row['responsavel']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"responsavel\")'></i>
            </div>
          </div>";
          
          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>Capacidade de Acolhimento</span> 
            <div class='div-campo'>
              <div id='capacidade_acolhimento' class='input-perfil'>".$row['capacidade_acolhimento']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"capacidade_acolhimento\")'></i>
            </div>
          </div>";
          
          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>Vagas Disponíveis</span> 
            <div class='div-campo'>
              <div id='vagas_disponiveis' class='input-perfil'>".$row['vagas']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"vagas_disponiveis\")'></i>
            </div>
          </div>";

          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>Convênios</span>
            <div class='div-campo'>
              <div class='input-perfil convenios'>";
                echo $row['privada'] == 1 ? '-Privada<br>' : '';
                echo $row['filantropica'] == 1 ? '-Filantrópica<br>' : '';
                echo $row['convenio_publico_estadual'] == 1 ? '-Convênio Estadual<br>' : '';
                echo $row['convenio_publico_municipal'] == 1 ? '-Convênio Municipal<br>' : '';
                if ($row['privada'] != 1 && $row['filantropica'] != 1 && $row['convenio_publico_estadual'] != 1 && $row['convenio_publico_municipal'] != 1) {
                  echo "Não há convênios";
                }
              echo "</div>
              <i class='fas fa-edit edit-icon' onclick='editConvenios()'></i>
            </div>
          </div>";

          echo "</section>
          <section class='perfil-ilpi-right'>";

          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>Equipe técnica</span> 
            <div class='div-campo'>
              <div id='equipe_tecnica' class='input-perfil input-text-perfil'>".$row['equipe_tecnica']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"equipe_tecnica\")'></i>
            </div>
          </div>";

          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>Estrutura Física</span> 
            <div class='div-campo'>
              <div id='estrutura_fisica' class='input-perfil input-text-perfil'>".$row['estrutura_fisica']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"estrutura_fisica\")'></i>
            </div>
          </div>";

          echo "<div class='div-perfil'> 
            <span class='titulos-perfil'>Atividades Semanais</span> 
            <div class='div-campo'>
              <div id='atividades_semanais' class='input-perfil input-text-perfil'>".$row['atividades_semanais']."</div>
              <i class='fas fa-edit edit-icon' onclick='editField(\"atividades_semanais\")'></i>
            </div>
          </div>";
          }

        echo "</section>
        </div>";
      } 
      else {
        echo "<p>O perfil procurado não foi encontrado. </p>";
      }

?>
  
</body>
</html>
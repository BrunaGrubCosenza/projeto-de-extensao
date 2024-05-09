<?php
require_once "../includes/valida-acesso.inc.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Dados das ILPIs </title>
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <header>
    <img class="img-header" src="../logo.png"
      alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
    <nav class="nav-header">
      <a href="homeAdmin.php"><i class="fa-solid fa-house"></i></a>
    </nav>
  </header>

  <section class="filtros">

    <div title="Buscar ILPI por nome, CNPJ ou município">
      <label for="filtro"><i class="fas fa-search"></i> </label>
      <input type="text" id="filtro" placeholder="Buscar por nome, CNPJ ou município"
        oninput="filtrarPorNomeOuCNPJOuMunicipio()">
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
            while ($row = $result->fetch_assoc()) {
              $municipios[] = $row['municipio'];
            }
          }
          usort($municipios, function ($a, $b) {
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

  <!--Excluindo ILPI-->
  <span id="spanExcluir" style="display: none;">Excluir</span>
  <!-- Modal -->
  <div id="modalExcluir" class="modal" style="display: none">
    <div class="modal-header">
      <span>Excluir</span>
      <button class="botao-modal fechar close">&times;</button>
    </div>
    <div class="modal-body">
      <span>Deseja realmente excluir este(s) item(ns)?</span>
      <div class="ilpisSelecionadas">
        <ul id="nomesSelecionados"></ul>
      </div>
      <div>
        <button id="btnCancelarExclusao" class="botao-modal">Cancelar</button>
        <button id="btnConfirmarExclusao" class="botao-modal" name="excluirIlpi">Confirmar</button>
      </div>
    </div>
  </div>
  <div id='overlay' style='display: none;'></div>

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
            <th></th>
            <th>CNPJ</th>
            <th>Nome</th>
            <th>Município</th>
            <th style='text-align: center'>Capacidade de Acolhimento</th>
            <th style='text-align: center'>Vagas Disponíveis</th>    
            <th>Convênios</th>
          </tr>
        </thead>
        <tbody>";
      while ($row = $result->fetch_assoc()) {
        $cnpj_ilpi = $row['cnpj'];
        echo "<tr>";
        echo "<td><input type='checkbox' value='$cnpj_ilpi'></td>";
        echo "<td> <div style='width: 120px' class='link-tabela-dados-gerais'> <a href='../ilpi/perfilIlpi.php?cnpj_ilpi=$cnpj_ilpi'> {$row['cnpj']} </a> </div> </td>";
        echo "<td> <div style='width: 180px' class='link-tabela-dados-gerais'> <a href='../ilpi/perfilIlpi.php?cnpj_ilpi=$cnpj_ilpi'> {$row['nome']} </a> </div> </td>";
        echo "<td>" . $row['municipio'] . "</td>";
        echo "<td style='text-align: center'>" . $row['capacidade_acolhimento'] . "</td>";
        echo "<td style='text-align: center'>" . $row['vagas'] . "</td>";
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
    <tbody>
      <tr>
        <td colspan='6' style='text-align: center;'>0 resultados</td>
      </tr>
    </tbody>
    </table>";
    }
    ?>
    <script>
      document.getElementById('ordenarVagas').addEventListener('click', function () {
        var linhas = Array.from(document.querySelectorAll('.tabela-dados-gerais tbody tr'));

        linhas.sort(function (a, b) {
          var vagasA = parseInt(a.querySelector('td:nth-child(6)').textContent);
          var vagasB = parseInt(b.querySelector('td:nth-child(6)').textContent);
          return vagasB - vagasA;
        });

        var tbody = document.querySelector('.tabela-dados-gerais tbody');
        tbody.innerHTML = '';
        linhas.forEach(function (linha) {
          tbody.appendChild(linha);
        });
      });

      function filtrarConvenio() {
        var filtrosSelecionados = Array.from(document.getElementById('convenio').selectedOptions).map(option => option.value);
        var filtroMunicipio = removerAcentos(document.getElementById('municipio').value.toLowerCase());

        var linhas = Array.from(document.querySelectorAll('.tabela-dados-gerais tbody tr'));

        linhas.forEach(function (linha) {
          var convenios = linha.querySelector('td:nth-child(7)').innerHTML;

          var mostrarPorConvenio = filtrosSelecionados.includes('todos') || filtrosSelecionados.some(function (filtro) {
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

          var municipio = removerAcentos(linha.querySelector('td:nth-child(4)').textContent.trim().toLowerCase());
          var mostrarPorMunicipio = (filtroMunicipio === 'todos' || municipio === filtroMunicipio);

          linha.style.display = mostrarPorConvenio && mostrarPorMunicipio ? '' : 'none';
        });
      }

      //Município
      function removerAcentos(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
      }

      document.getElementById('municipio').addEventListener('change', function () {
        var filtroSelecionado = removerAcentos(this.value.toLowerCase()); // Converter para minúsculas e remover acentos
        var linhas = Array.from(document.querySelectorAll('.tabela-dados-gerais tbody tr'));

        linhas.forEach(function (linha) {
          var municipio = removerAcentos(linha.querySelector('td:nth-child(4)').textContent.trim().toLowerCase()); // Converter para minúsculas e remover acentos
          var mostrarLinha = (filtroSelecionado === 'todos' || municipio === filtroSelecionado);
          linha.style.display = mostrarLinha ? '' : 'none';
        });

        // Resetar o filtro de convênio para "Todos"
        document.getElementById('convenio').value = 'todos';

        // Filtrar novamente após a mudança no município
        filtrarConvenio();
      });

      document.getElementById('convenio').addEventListener('change', function () {
        filtrarConvenio();
      });


      function filtrarPorNomeOuCNPJOuMunicipio() {
        var filtro = removerAcentos(document.getElementById('filtro').value.trim().toLowerCase());
        var linhas = Array.from(document.querySelectorAll('.tabela-dados-gerais tbody tr'));

        // Desativar os campos de filtro de município e convênio se o campo de busca estiver preenchido
        var camposDesativados = filtro !== '';
        document.getElementById('municipio').disabled = camposDesativados;
        document.getElementById('convenio').disabled = camposDesativados;

        // Definir filtros de convênio e município como "todos" se o campo de busca estiver preenchido
        if (camposDesativados) {
          document.getElementById('convenio').value = 'todos';
          document.getElementById('municipio').value = 'todos';
        }

        linhas.forEach(function (linha) {
          var nome = removerAcentos(linha.querySelector('td:nth-child(3)').textContent.trim().toLowerCase()); // Coluna do nome
          var cnpj = removerAcentos(linha.querySelector('td:nth-child(2)').textContent.trim().toLowerCase()); // Coluna do CNPJ
          var municipio = removerAcentos(linha.querySelector('td:nth-child(4)').textContent.trim().toLowerCase()); // Coluna do Município

          // Verifica se o nome, CNPJ ou Município contém o termo de busca
          var mostrarLinha = nome.includes(filtro) || cnpj.includes(filtro) || municipio.includes(filtro);

          // Exibe ou oculta a linha com base no filtro
          linha.style.display = mostrarLinha ? '' : 'none';
        });
      }

      // Adicionar evento para limpar o filtro quando o campo de busca é limpo
      document.getElementById('filtro').addEventListener('input', function () {
        if (this.value.trim() === '') {
          document.getElementById('municipio').disabled = false;
          document.getElementById('convenio').disabled = false;
          filtrarPorNomeOuCNPJ(); // Chamar a função de filtragem para restaurar os filtros de município e convênio
        }
      });

      //EXCLUINDO ILPI
      var nomesSelecionados = []; // Array para armazenar os nomes dos itens selecionados

      // Função para verificar a seleção dos checkboxes
      function verificarSelecao() {
        var checkboxes = document.querySelectorAll('.tabela-dados-gerais tbody input[type="checkbox"]');
        var spanExcluir = document.getElementById('spanExcluir');

        // Limpar o array de nomes selecionados
        nomesSelecionados = [];

        // Verificar se algum checkbox está selecionado e adicionar o nome correspondente ao array
        checkboxes.forEach(function (checkbox) {
          if (checkbox.checked) {
            var nome = checkbox.closest('tr').querySelector('td:nth-child(3)').textContent; // Obter o nome do item
            nomesSelecionados.push(nome); // Adicionar o nome ao array
          }
        });

        // Alterar o estilo do span "Excluir" com base na seleção dos checkboxes
        if (nomesSelecionados.length > 0) {
          spanExcluir.style.display = 'inline'; // Tornar o span visível
        } else {
          spanExcluir.style.display = 'none'; // Ocultar o span
        }
      }

      // Adicionar evento para ouvir a mudança de estado dos checkboxes
      document.querySelectorAll('.tabela-dados-gerais tbody input[type="checkbox"]').forEach(function (checkbox) {
        checkbox.addEventListener('change', verificarSelecao);
      });

      // Função para abrir o modal
      function abrirModal() {
        var modal = document.getElementById('modalExcluir');
        modal.style.display = 'block';
        document.getElementById('overlay').style.display = 'block';

        // Exibir os nomes dos itens selecionados no modal
        var listaNomes = document.getElementById('nomesSelecionados');
        listaNomes.innerHTML = '';
        nomesSelecionados.forEach(function (nome) {
          var li = document.createElement('li');
          li.textContent = nome;
          listaNomes.appendChild(li);
        });
      }

      // Função para fechar o modal
      function fecharModal() {
        var modal = document.getElementById('modalExcluir');
        modal.style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
        // Recarregar a página
        location.reload();
      }

      // Função para lidar com o clique no botão "Confirmar"
      document.getElementById('btnConfirmarExclusao').addEventListener('click', function () {
        // Recupera todos os checkboxes marcados na tabela
        var checkboxes = document.querySelectorAll('.tabela-dados-gerais tbody input[type="checkbox"]:checked');

        // Array para armazenar os CNPJs selecionados
        var cnpjsSelecionados = [];

        // Itera sobre os checkboxes marcados para obter os CNPJs
        checkboxes.forEach(function (checkbox) {
          // Adiciona o valor do CNPJ ao array de CNPJs selecionados
          cnpjsSelecionados.push(checkbox.value);
        });

        // Verifica se algum CNPJ foi selecionado
        if (cnpjsSelecionados.length > 0) {
          // Envia uma solicitação AJAX para o script PHP de exclusão
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "../includes/excluir-ilpi.inc.php", true);
          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
              if (xhr.status == 200) {
                // Exibe a resposta do servidor (pode ser uma mensagem de sucesso ou erro)
                console.log(xhr.responseText);
                fecharModal();
              } else {
                // Exibe uma mensagem de erro caso a solicitação falhe
                console.error("Erro na solicitação AJAX: " + xhr.statusText);
              }
            }
          };
          // Envia os CNPJs selecionados como parâmetros da solicitação POST
          xhr.send("ilpisSelecionadas=" + JSON.stringify(cnpjsSelecionados));
        } else {
          // Se nenhum CNPJ estiver selecionado, exibe uma mensagem de erro ou realiza outra ação apropriada
          console.log("Nenhum CNPJ selecionado");
        }
      });

      // Função para lidar com o clique no botão "Cancelar"
      document.getElementById('btnCancelarExclusao').addEventListener('click', function () {
        // Se o usuário cancelar a exclusão, basta fechar o modal
        fecharModal();
      });

      // Adicionar evento de clique ao elemento "Excluir" para abrir o modal
      document.getElementById('spanExcluir').addEventListener('click', function () {
        abrirModal();
      });
      document.querySelector('.modal .close').addEventListener('click', fecharModal);

      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            if (xhr.responseText === "Exclusão bem-sucedida") {
              // Se a exclusão for bem-sucedida, feche o modal
              fecharModal();
              // Redirecione o usuário após um breve intervalo de tempo
              setTimeout(function () {
                window.location.href = 'paginaTabelaIlpi.php'; // Redireciona para a página desejada
              }, 1000); // Tempo em milissegundos (1 segundo, ajuste conforme necessário)
            } else {
              // Se houver um erro na exclusão, exiba uma mensagem de erro
              console.error("Erro ao excluir: " + xhr.responseText);
            }
          } else {
            // Se houver um erro na requisição AJAX
            console.error("Erro na requisição AJAX");
          }
        }
      };

    </script>

  </section>
</body>

</html>
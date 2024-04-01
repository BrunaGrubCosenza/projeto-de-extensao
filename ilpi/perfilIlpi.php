<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Perfil ILPI </title>
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
  <header>
    <img class="img-header" src="../logo.png"
      alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
  </header>

  <h2 class="h2-titulo"> Perfil </h2>

  <button id="btnEditarPerfil" class='botao-modal'><i class="fas fa-edit edit-icon"></i> Editar</button>

  <?php

session_start();
if (!isset($_SESSION['cnpj_ilpi'])) {
    // Redirecionar para a página de login se o CNPJ não estiver definido na sessão
    header("Location: loginIlpi.php");
    exit(); // Certifique-se de sair do script após redirecionar
}

  require "../includes/dados-conexao.inc.php";
  require "../includes/conectar.inc.php";
  require "../includes/abrir-banco.inc.php";
  require "../includes/definir-charset.inc.php";

  if (isset($_SESSION['cnpj_ilpi'])) {
    $cnpjAtual = $_SESSION['cnpj_ilpi'];
    $sql = "SELECT * FROM $nomeDaTabela1 WHERE cnpj = '$cnpjAtual' ";
    $resultado = $conexao->query($sql);
    
    //criando as variáveis
    $nome; 
    $cnpj;
    $endereco; 
    $municipio; 
    $cep;
    $email; 
    $telefone; 
    $responsavel; 
    $capacidade_acolhimento;
    $vagas_disponiveis;
    $privada;
    $filantropica;
    $convenio_publico_estadual; 
    $convenio_publico_municipal; 
    $equipe_tecnica; 
    $estrutura_fisica;
    $atividades_semanais;
    
    //definido as variáveis 
    if ($resultado->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $nome = $row['nome'];
        $cnpj = $row['cnpj'];
        $endereco = $row['endereco'];
        $municipio = $row['municipio'];
        $cep = $row['cep'];
        $email = $row['email'];
        $telefone = $row['telefone'];
        $responsavel = $row['responsavel'];
        $capacidade_acolhimento = $row['capacidade_acolhimento'];
        $vagas_disponiveis = $row['vagas'];
        $privada = $row['privada'];
        $filantropica = $row['filantropica'];
        $convenio_publico_estadual = $row['convenio_publico_estadual'];
        $convenio_publico_municipal = $row['convenio_publico_municipal'];
        $equipe_tecnica = $row['equipe_tecnica'];
        $estrutura_fisica = $row['estrutura_fisica'];
        $atividades_semanais = $row['atividades_semanais'];
      }
    }

    echo '<pre>'; print_r($resultado); echo '</pre>';

    echo "
        <div class='perfil-ilpi'>
          <section class='perfil-ilpi-left'>
          <div>

            <div class='div-perfil'> 
              <span class='titulos-perfil'>Nome</span> 
              <div id='nome' class='input-perfil'>", $nome, "</div>
            </div>

            <div class='div-perfil'> 
              <span class='titulos-perfil'>CNPJ</span> 
              <div id='cnpj' class='input-perfil'>", $cnpj, "</div>
            </div>

            <div class='div-perfil'> 
              <span class='titulos-perfil'>Endereço</span> 
              <div id='endereco' class='input-perfil'>", $endereco, "</div>
            </div>

            <div class='div-perfil'> 
              <span class='titulos-perfil'>Município</span> 
              <div id='municipio' class='input-perfil'>", $municipio, "</div>
            </div>

            <div class='div-perfil'> 
              <span class='titulos-perfil'>CEP</span> 
              <div id='cep' class='input-perfil'>", $cep, "</div>
            </div>
          
            <div class='div-perfil'> 
              <span class='titulos-perfil'>E-mail</span> 
              <div id='email' class='input-perfil'>", $email, "</div>
            </div>
          
            <div class='div-perfil'> 
              <span class='titulos-perfil'>Telefone</span> 
              <div id='telefone' class='input-perfil'>", $telefone, "</div>
            </div>
          
            <div class='div-perfil'> 
              <span class='titulos-perfil'>Responsável</span> 
              <div id='responsavel' class='input-perfil'>", $responsavel, "</div>
            </div>
          
            <div class='div-perfil'> 
              <span class='titulos-perfil'>Capacidade de Acolhimento</span> 
              <div id='capacidade_acolhimento' class='input-perfil'>", $capacidade_acolhimento, "</div>

            </div>
          
            <div class='div-perfil'> 
              <span class='titulos-perfil'>Vagas Disponíveis</span> 
              <div id='vagas_disponiveis' class='input-perfil'>", $vagas_disponiveis, "</div>
            </div>

          </div>
          </section>
          <section class='perfil-ilpi-right'>
            <div>
              <div class='div-perfil'> 
                <span class='titulos-perfil'>Convênios</span>
                <div class='input-perfil convenios'>";
    echo $privada == 1 ? '-Privada<br>' : '';
    echo $filantropica == 1 ? '-Filantrópica<br>' : '';
    echo $convenio_publico_estadual == 1 ? '-Convênio Estadual<br>' : '';
    echo $convenio_publico_municipal == 1 ? '-Convênio Municipal<br>' : '';
    if ($privada != 1 && $filantropica != 1 && $convenio_publico_estadual != 1 && $convenio_publico_municipal != 1) {
      echo "Não há convênios";
    }
    echo "</div>
              </div>

              <div class='div-perfil'> 
                <span class='titulos-perfil'>Equipe técnica</span> 
                <textarea id='equipe_tecnica' class='textarea input-perfil input-text-perfil' disabled>", $equipe_tecnica, "</textarea>
              </div>

              <div class='div-perfil'> 
                <span class='titulos-perfil'>Estrutura Física</span> 
                <textarea id='estrutura_fisica' class='textarea input-perfil input-text-perfil' disabled>", $estrutura_fisica, "</textarea>
              </div>

              <div class='div-perfil'> 
                <span class='titulos-perfil'>Atividades Semanais</span>
                <textarea id='atividades_semanais' class='textarea input-perfil input-text-perfil' disabled>", $atividades_semanais, "</textarea>
              </div>
            </div>
          </section>
        </div>
        
        
        <div id='modalEditarPerfil' style='display: none;'>
          <div class='modal-header'>
            <span><i class='fas fa-edit edit-icon'></i> Editar</span>
            <button class='botao-modal fechar'>X</button>
          </div>
          <div class='modal-body'>
            <form id='formEditarPerfil' action='perfilIlpi.php' method='post'>
              <input type='hidden' name='cnpjAtual' value='", $cnpjAtual, "'>
              <label class='alinha' title='Não pode ser alterado'> CNPJ: </label>
              <input type='text' name='cnpj' value='", $cnpj, "' required disabled title='Não pode ser alterado'><span title='Preenchimento obrigatório'> *</span> <br>

              <label class='alinha'> Nome: </label>
              <input type='text' name='nome' value='", $nome, "' required><span title='Preenchimento obrigatório'> *</span> <br>        
              
              <label class='alinha'> Endereço: </label>
              <input type='text' name='endereco' value='", $endereco, "'> <br>
              
              
              <label class='alinha'> Municipio: </label>
              <input type='text' name='municipio' value='", $municipio, "' required><span title='Preenchimento obrigatório'> *</span> <br>
              
              
              <label class='alinha'> CEP: </label>
              <input type='text' name='cep' value='", $cep, "'> <br>
              
              
              <label class='alinha'> E-mail: </label>
              <input type='email' name='email' value='", $email, "' required><span title='Preenchimento obrigatório'> *</span> <br>
              
              
              <label class='alinha'> Telefone: </label>
              <input type='text' name='telefone' value='", $telefone, "' required><span title='Preenchimento obrigatório'> *</span> <br>
              
              
              <label class='alinha'> Responsável: </label>
              <input type='text' name='responsavel' value='", $responsavel, "'> <br>
              
              
              <label class='alinha'> Capacidade de Acolhimento: </label>
              <input type='number' name='capacidadeAcolhimento' min='0' value='", $capacidade_acolhimento, "'> <br>
              
              
              <label class='alinha'> Vagas Disponíveis: </label>
              <input type='number' name='vagas' min='0' value='", $vagas_disponiveis, "'> <br>
              
              
              <label class='alinha'> Convênios: </label>
              <label class='checkbox'>
                <input type='checkbox' name='opcao1' value='1'", $privada == 1 ? 'checked' : '', " >Privado
              </label><br>
              <label class='checkbox'>
                <input type='checkbox' name='opcao2' value='1'", $filantropica == 1 ? 'checked' : '', " >Filantrópico
              </label><br>
              <label class='checkbox'>
                <input type='checkbox' name='opcao3' value='1'", $convenio_publico_estadual == 1 ? 'checked' : '', " >Convênio Público Estadual
              </label><br>
              <label class='checkbox'>
                <input type='checkbox' name='opcao4' value='1'", $convenio_publico_municipal == 1 ? 'checked' : '', " >Convênio Público Municipal
              </label><br>
              <br>
              
              
              <label class='alinha'> Equipe Tecnica: </label>
              <textarea class='textarea' name='equipe'>", $equipe_tecnica, "</textarea> <br>
              
              
              <label class='alinha'> Estrutura Física: </label>
              <textarea class='textarea' name='estrutura'>", $estrutura_fisica, "</textarea> <br>
              
              
              <label class='alinha'> Atividades Semanais: </label>
              <textarea class='textarea' name='atvdSemanal'>", $atividades_semanais, "</textarea> <br>

              <button type='submit' class='botao-modal salvar' name='editar'>Salvar</button>
            </form>
          </div>
        </div>
        <div id='overlay' style='display: none;'></div>        
    ";

  } else {
    echo "<p>O perfil procurado não foi encontrado. </p>";
  }

  if (isset($_POST['editar'])) {

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $municipio = $_POST['municipio'];
    $cep = $_POST['cep'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $responsavel = $_POST['responsavel'];
    $capacidade_acolhimento = $_POST['capacidadeAcolhimento'];
    $vagas_disponiveis = $_POST['vagas'];
    $privada = isset($_POST['opcao1']) ? 1 : 0;
    $filantropica = isset($_POST['opcao2']) ? 1 : 0;
    $convenio_publico_estadual = isset($_POST['opcao3']) ? 1 : 0;
    $convenio_publico_municipal = isset($_POST['opcao4']) ? 1 : 0;
    $equipe_tecnica = $_POST['equipe'];
    $estrutura_fisica = $_POST['estrutura'];
    $atividades_semanais = $_POST['atvdSemanal'];

    require "../includes/editarPerfil.inc.php";
  }

  ?>
  <script>
    document.getElementById('btnEditarPerfil').addEventListener('click', function () {
      document.getElementById('modalEditarPerfil').style.display = 'block';
      document.getElementById('overlay').style.display = 'block';
    });

    document.querySelector('.fechar').addEventListener('click', function () {
      document.getElementById('modalEditarPerfil').style.display = 'none';
      document.getElementById('overlay').style.display = 'none';
    });
  </script>

</body>

</html>
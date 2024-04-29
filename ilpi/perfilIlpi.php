<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Perfil ILPI </title>
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <header>
    
    <img class="img-header" src="../logo.png" alt="Logo Secretaria da Assistencia Social, Mulher e Familia de Santa Catarina">
    <?php
      session_start();
      if (isset($_SESSION["usuario_admin"])){
        $usuario_admin = $_SESSION['usuario_admin'];
      }
      if($usuario_admin==1){
        echo '
          <nav class="nav-header">
            <a href="../admin/homeAdmin.php" style="margin-right: 15px"><i class="fa-solid fa-house"></i></a>
            <button id="logoutButtonAdmin">Sair do sistema</button>
          </nav>
        ';
      }
      if($usuario_admin!=1) {
        echo '<a href="loginIlpi.php" id="logout">Sair do sistema</a>';
      }
    ?>

  </header>

  <h2 class="h2-titulo"> Perfil </h2>
  

  <?php
  if (isset($_GET['cnpj_ilpi'])) {
    $_SESSION['cnpj_ilpi'] = $_GET['cnpj_ilpi'];
  }

  require "../includes/dados-conexao.inc.php";
  require "../includes/conectar.inc.php";
  require "../includes/abrir-banco.inc.php";
  require "../includes/definir-charset.inc.php";

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar'])) {
    // Se o formulário de edição foi enviado, usamos os dados do formulário
    $cnpjAtual = $_POST['cnpjAtual'];
  } elseif(isset($_SESSION['cnpj_ilpi'])) {
    // Se não estamos lidando com um envio de formulário, mas a sessão cnpj_ilpi está definida, então podemos carregar o perfil normalmente
    $cnpjAtual = $_SESSION['cnpj_ilpi'];
}

  if (isset($_SESSION['cnpj_ilpi'])) {

    

    /*$sql = "SELECT id FROM $nomeDaTabela2 WHERE cnpj_ilpi = '$cnpjAtual' ";
    $resultado = $conexao->query($sql);
    $vetor = $resultado->fetch_array();
    $id = $vetor['id'];*/
    $id = null;
    if($usuario_admin==1){
      echo '<div id="idIlpi" title="Caso a ILPI precise trocar sua senha, ela precisará entrar em contato para saber qual seu ID">ID: ', $id, '</div>';
    }


    $sql = "SELECT * FROM $nomeDaTabela1 WHERE cnpj = '$cnpjAtual' ";
    $resultado = $conexao->query($sql);
    
    //definido as variáveis 
    if ($resultado->num_rows > 0) {
      while ($row = $resultado->fetch_assoc()) {
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
        $custo_vaga = $row['custo_vaga'];
      }
    }

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

<<<<<<< HEAD
                <div class='div-perfil'> 
                  <span class='titulos-perfil'>Atividades Semanais</span>
                  <textarea id='atividades_semanais' class='textarea input-perfil input-text-perfil' disabled>", $atividades_semanais, "</textarea>
                </div>
=======
              <div class='div-perfil'> 
                <span class='titulos-perfil'>Atividades Semanais</span>
                <textarea id='atividades_semanais' class='textarea input-perfil input-text-perfil' disabled>", $atividades_semanais, "</textarea>
              </div>

              <div class='div-perfil'> 
                <span class='titulos-perfil'>Atividades Semanais</span>
                <textarea id='custo_vaga' class='textarea input-perfil input-text-perfil' disabled>", $custo_vaga, "</textarea>
              </div>
>>>>>>> 5c776428e75b81da9e5e216993595cc510d7ffb9
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
              <label class='alinha' > CNPJ: </label>
              <input type='text' name='cnpj' value='", $cnpj, "' required><span title='Preenchimento obrigatório'> *</span> <br>

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

              <label class='alinha'> Custo Mensal por Vaga: </label>
              <textarea class='textarea' name='custoVaga'>", $custo_vaga, "</textarea> <br>

              <button type='submit' class='botao-modal salvar' name='editar'>Salvar</button>
            </form>
          </div>
        </div>
        <div id='overlay' style='display: none;'></div>  
        <button id='btnEditarPerfil' class='botao-modal'><i class='fas fa-edit edit-icon'></i> Editar</button>      
    ";

  } else {
    echo "<p>O perfil procurado não foi encontrado. </p>";
  }

  if (isset($_POST['editar'])) {

    $cnpj = $_POST['cnpj'];
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
    $custo_vaga = $_POST['custoVaga'];

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


     // Adicionando evento de clique - logout
     document.getElementById('logoutButtonAdmin').addEventListener('click', function() {
      // Limpar a sessão do usuário ou realizar qualquer ação de logout necessária
      // Redirecionar para a página de login
      window.location.href = "../admin/loginAdmin.php";
    });
    
  </script> 
 
</body>

</html>
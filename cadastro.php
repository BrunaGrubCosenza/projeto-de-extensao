<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Login de usuário </title>
  <link rel="stylesheet" href="formata-login.css">
</head>

<body>
  <h1> Cadastro de usuário com Sessões em PHP </h1>

  <form action="cadastro.php" method="post">
    <fieldset>
      <legend> Cadastro </legend>

      <label class="alinha"> Nome da ILPI: </label>
      <input type="text" name="nome" autofocus> <br>

      <label class="alinha"> Endereço: </label>
      <input type="text" name="endereco" autofocus> <br>

      <label class="alinha"> Municipio: </label>
      <input type="text" name="municipio" autofocus> <br>

      <label class="alinha"> CEP: </label>
      <input type="text" name="cep" autofocus> <br>

      <label class="alinha"> E-mail: </label>
      <input type="email" name="email"> <br>

      <label class="alinha"> Telefone: </label>
      <input type="text" name="telefone"> <br>

      <label class="alinha"> Responsável: </label>
      <input type="password" name="responsavel"> <br>

      <label class="alinha"> Capacidade de Acolhimento: </label>
      <input type="number" name="qtdTOTALvagas" min="0"> <br>

      <label class="alinha"> Vagas Disponíveis: </label>
      <input type="number" name="qtdvagas" min="0"> <br>

      <label class="alinha"> Tipo de Instituição: </label>
      <label>
        <input type="checkbox" name="opcao" value="nao_aceita"> Não Aceita
      </label>
      <label>
        <input type="checkbox" name="opcao" value="privada"> Privada
      </label>
      <label>
        <input type="checkbox" name="opcao" value="convenio_publico_estadual"> Convênio Público Estadual
      </label>
      <label>
        <input type="checkbox" name="opcao" value="convenio_publico_municipal"> Convênio Público Municipal
      </label>
      <label>
        <input type="checkbox" name="opcao" value="filantropica"> Filantrópica
      </label>
      <br>

    <label class="alinha"> Equipe Tecnica: </label>
    <input type="text" name="equipe" autofocus> <br>

    <label class="alinha"> Estrutura Física: </label>
    <input type="text" name="estrutura" autofocus> <br>

    <label class="alinha"> Atividades Semanais: </label>
    <input type="text" name="ATVDsemanal" autofocus> <br>

      <div>
        <button name="cadastrar"> Cadastrar usuário </button>
      </div>
    </fieldset>
  </form>

  <?php
  require "./includes/dados-conexao.inc.php";
  require "./includes/conectar.inc.php";
  require "./includes/criar-banco.inc.php";
  require "./includes/abrir-banco.inc.php";
  require "./includes/definir-charset.inc.php";
  require "./includes/criar-tabela.inc.php";

  if (isset($_POST['cadastrar'])) {
    require "./includes/cadastrar.inc.php";
  }

  require "./includes/desconectar.inc.php";
  ?>
</body>

</html>
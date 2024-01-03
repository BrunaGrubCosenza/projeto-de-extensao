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
      <input type="text" name="nome" autofocus require> <br>

      <label class="alinha"> CNPJ: </label>
      <input type="text" name="cnpj" require> <br>

      <label class="alinha"> Endereço: </label>
      <input type="text" name="endereco" require> <br>

      <label class="alinha"> Municipio: </label>
      <input type="text" name="municipio" require> <br>

      <label class="alinha"> CEP: </label>
      <input type="text" name="cep" require> <br>

      <label class="alinha"> E-mail: </label>
      <input type="email" name="email" require> <br>

      <label class="alinha"> Telefone: </label>
      <input type="text" name="telefone" require> <br>

      <label class="alinha"> Responsável: </label>
      <input type="password" name="responsavel" require> <br>

      <label class="alinha"> Capacidade de Acolhimento: </label>
      <input type="number" name="qtdTotalVagas" min="0" require> <br>

      <label class="alinha"> Vagas Disponíveis: </label>
      <input type="number" name="qtdVagas" min="0" require> <br>

      <label class="alinha"> Convênios: </label>
      <label>
        <input type="checkbox" name="opcao1" value="privada"> Privado
      </label>
      <label>
        <input type="checkbox" name="opcao2" value="convenio_publico_estadual"> Convênio Público Estadual
      </label>
      <label>
        <input type="checkbox" name="opcao3" value="convenio_publico_municipal"> Convênio Público Municipal
      </label>
      <label>
        <input type="checkbox" name="opcao4" value="filantropica"> Filantrópico
      </label>
      <br>

    <label class="alinha"> Equipe Tecnica: </label>
    <input type="text" name="equipe"> <br>

    <label class="alinha"> Estrutura Física: </label>
    <input type="text" name="estrutura"> <br>

    <label class="alinha"> Atividades Semanais: </label>
    <input type="text" name="atvdSemanal"> <br>

      <div>
        <button name="cadastrar"> Cadastrar usuário </button>
      </div>
    </fieldset>
  </form>

  <?php
  require "./includes/dados-conexao.inc.php";
  require "./includes/conectar.inc.php";
  require "./includes/abrir-banco.inc.php";
  require "./includes/definir-charset.inc.php";

  if (isset($_POST['cadastrar'])) {
    require "./includes/cadastrar.inc.php";
  }

  require "./includes/desconectar.inc.php";
  ?>
</body>

</html>
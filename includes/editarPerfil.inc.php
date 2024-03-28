<?php
$nomeIlpi = trim($conexao->escape_string($_POST['nome']));
$endereco = trim($conexao->escape_string($_POST['endereco']));
$municipio = trim($conexao->escape_string($_POST['municipio']));
$cep = trim($conexao->escape_string($_POST['cep']));
$email = trim($conexao->escape_string($_POST['email']));
$telefone = trim($conexao->escape_string($_POST['telefone']));
$responsavel = trim($conexao->escape_string($_POST['responsavel']));
$capacidadeAcolhimento = trim($conexao->escape_string($_POST['capacidadeAcolhimento']));
$vagas = trim($conexao->escape_string($_POST['vagas']));
$checkboxValue1 = trim($conexao->escape_string(isset($_POST['opcao1']) ? 1 : 0));
$checkboxValue2 = trim($conexao->escape_string(isset($_POST['opcao2']) ? 1 : 0));
$checkboxValue3 = trim($conexao->escape_string(isset($_POST['opcao3']) ? 1 : 0));
$checkboxValue4 = trim($conexao->escape_string(isset($_POST['opcao4']) ? 1 : 0));
$equipe = trim($conexao->escape_string($_POST['equipe']));
$estrutura = trim($conexao->escape_string($_POST['estrutura']));
$atvdSemanal = trim($conexao->escape_string($_POST['atvdSemanal']));
$cnpjAtual = $_POST['cnpjAtual'];

$sql = "UPDATE $nomeDaTabela1 SET 
            `nome` = '$nomeIlpi',
            `endereco` = '$endereco',
            `municipio` = '$municipio',
            `cep` = '$cep',
            `email` = '$email',
            `telefone` = '$telefone',
            `responsavel` = '$responsavel',
            `capacidade_acolhimento` = '$capacidadeAcolhimento',
            `vagas` = '$vagas',
            `privada` = '$checkboxValue1',
            `filantropica` = '$checkboxValue2',
            `convenio_publico_estadual` = '$checkboxValue3',
            `convenio_publico_municipal` = '$checkboxValue4',
            `equipe_tecnica` = '$equipe',
            `estrutura_fisica` = '$estrutura',
            `atividades_semanais` = '$atvdSemanal'
            WHERE `cnpj` = '$cnpjAtual'
            ";

if ($conexao->query($sql) === TRUE) {
    header("Location: ../ilpi/perfilIlpi.php?cnpj_ilpi=$cnpjAtual");
    exit();
} else {
    echo "Erro ao atualizar os dados: " . $conexao->error;
}
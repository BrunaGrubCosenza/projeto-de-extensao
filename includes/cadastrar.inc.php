<?php
//Dados ILPI

$cnpj = trim($conexao->escape_string($_POST['cnpj']));
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

//gravamos os dados do usuário no banco
$sql = "INSERT $nomeDaTabela1 VALUES(
             '$cnpj',
             '$nomeIlpi',
             '$endereco',
             '$municipio',
             '$cep',
             '$email',
             '$telefone',
             '$responsavel',
             '$capacidadeAcolhimento',
             '$vagas',
             '$checkboxValue1',
             '$checkboxValue2',
             '$checkboxValue3',
             '$checkboxValue4',
             '$equipe',
             '$estrutura',
             '$atvdSemanal')";
$conexao->query($sql) or die($conexao->error);

// Inserindo dados na tabela usuarios
$senha = password_hash($cnpj, PASSWORD_ARGON2I);
$sql_usuarios = "INSERT INTO usuarios (cnpj_ilpi, email, senha_hash, usuario_admin, primeiro_acesso) VALUES ('$cnpj', '$email', '$senha', 0, 1)";
$conexao->query($sql_usuarios) or die($conexao->error);

if ($conexao) {
    // Exiba o pop-up usando JavaScript
    echo '<script>
    if (confirm("Cadastro realizado com sucesso! Deseja cadastrar outra ILPI?")) {
        window.location.href = "../admin/cadastroIlpi.php"; // substitua "pagina_a.php" pelo URL da página A
    } else {
        window.location.href = "../admin/homeAdmin.php"; // substitua "pagina_b.php" pelo URL da página B
    }
    </script>';
} else {
    // Se houver um erro na consulta, você pode exibir uma mensagem de erro
    echo '<script>alert("Erro ao cadastrar. Por favor, tente novamente.");</script>';
}
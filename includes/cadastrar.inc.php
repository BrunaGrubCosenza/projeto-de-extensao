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
$custoVaga = trim($conexao->escape_string($_POST['custoVaga']));

// Consulta para verificar se o CNPJ já existe no banco de dados
$sql_check_cnpj = "SELECT COUNT(*) AS total FROM $nomeDaTabela1 WHERE cnpj = '$cnpj'";
$result_check_cnpj = $conexao->query($sql_check_cnpj);
$row_check_cnpj = $result_check_cnpj->fetch_assoc();

// Verifica se já existe um registro com o CNPJ informado
if ($row_check_cnpj['total'] > 0) {
    // Se o CNPJ já existir, exibe uma mensagem de erro
    echo '<script>alert("Já existe uma ILPI cadastrada com este CNPJ. Por favor, verifique as informações e tente novamente.");</script>';
}

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
             '$atvdSemanal',
             '$custoVaga')";
$conexao->query($sql) or die($conexao->error);

//ID Randômico de seis dígitos
function generateRandomId() {
    return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
}

// Gere um número aleatório de seis dígitos para o ID
$random_id = generateRandomId();

// Verifique se o ID já existe na tabela de usuários
$sql_check_id = "SELECT COUNT(*) AS total FROM usuarios WHERE id = '$random_id'";
$result_check_id = $conexao->query($sql_check_id);
$row_check_id = $result_check_id->fetch_assoc();

// Verifica se o ID já está em uso
while ($row_check_id['total'] > 0) {
    // Se o ID já estiver em uso, gere um novo número
    $random_id = generateRandomId();
    $sql_check_id = "SELECT COUNT(*) AS total FROM usuarios WHERE id = '$random_id'";
    $result_check_id = $conexao->query($sql_check_id);
    $row_check_id = $result_check_id->fetch_assoc();
}

// Senha a partir do CNPJ (apenas para exemplo)
$senha = password_hash($cnpj, PASSWORD_ARGON2I);

// Inserir dados na tabela de usuários, incluindo o ID aleatório gerado
$sql_usuarios = "INSERT INTO usuarios (id, cnpj_ilpi, email, senha_hash, usuario_admin, primeiro_acesso) VALUES ('$random_id', '$cnpj', '$email', '$senha', 0, 1)";
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
<?php
require "../includes/dados-conexao.inc.php";
require "../includes/conectar.inc.php";

// Verifica se os CNPJs das ILPIs foram enviados
if (isset($_POST['ilpisSelecionadas']) && !empty($_POST['ilpisSelecionadas'])) {
    // Decodifica a string JSON para obter um array PHP
    $ilpisSelecionadas = json_decode($_POST['ilpisSelecionadas'], true);

    // Verifica se $ilpisSelecionadas é um array
    if (is_array($ilpisSelecionadas)) {
        // Loop sobre os CNPJs das ILPIs selecionadas e executar a exclusão no banco de dados
        foreach ($ilpisSelecionadas as $cnpj_ilpi) {
            // Consulta SQL para excluir a linha com base no CNPJ
            $sql = "DELETE FROM $nomeDaTabela1 WHERE cnpj = '$cnpj_ilpi'";
        
            // Executa a consulta SQL
            if ($conexao->query($sql) === TRUE) {
                // A exclusão foi bem-sucedida
                echo "Exclusão bem-sucedida";
            } else {
                // A exclusão falhou
                echo "Erro ao excluir: " . $conexao->error;
            }
        }
    } else {
        // Se não for um array, exibe uma mensagem de erro
        echo "Erro: CNPJs selecionados não são um array válido";
    }
} else {
    // Se nenhum CNPJ foi enviado, exibe uma mensagem de erro
    echo "Erro: Nenhum CNPJ selecionado para exclusão";
}

?>
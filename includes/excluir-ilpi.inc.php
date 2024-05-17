<?php
require "../includes/dados-conexao.inc.php";
require "../includes/conectar.inc.php";

// Verifica se os CNPJs das ILPIs foram enviados e se é um array válido
if (isset($_POST['ilpisSelecionadas']) && !empty($_POST['ilpisSelecionadas'])) {
    // Decodifica a string JSON para obter um array PHP
    $ilpisSelecionadas = json_decode($_POST['ilpisSelecionadas'], true);

    // Verifica se $ilpisSelecionadas é um array
    if (is_array($ilpisSelecionadas)) {
        // Inicia uma transação
        $conexao->begin_transaction();
        
        try {
            // Prepara as consultas SQL
            $stmt1 = $conexao->prepare("DELETE FROM $nomeDaTabela1 WHERE cnpj = ?");
            $stmt2 = $conexao->prepare("DELETE FROM $nomeDaTabela2 WHERE cnpj_ilpi = ?");
            
            // Loop sobre os CNPJs das ILPIs selecionadas e executar a exclusão no banco de dados
            foreach ($ilpisSelecionadas as $cnpj_ilpi) {
                // Vincula os parâmetros e executa a consulta para a primeira tabela
                $stmt1->bind_param("s", $cnpj_ilpi);
                if (!$stmt1->execute()) {
                    throw new Exception("Erro ao excluir da tabela1: " . $stmt1->error);
                }

                // Vincula os parâmetros e executa a consulta para a segunda tabela
                $stmt2->bind_param("s", $cnpj_ilpi);
                if (!$stmt2->execute()) {
                    throw new Exception("Erro ao excluir da tabela2: " . $stmt2->error);
                }
            }

            // Se todas as exclusões foram bem-sucedidas, confirma a transação
            $conexao->commit();
            echo "Exclusão bem-sucedida";
        } catch (Exception $e) {
            // Em caso de erro, reverte a transação
            $conexao->rollback();
            echo $e->getMessage();
        } finally {
            // Fecha as declarações preparadas
            $stmt1->close();
            $stmt2->close();
        }
    } else {
        // Se não for um array, exibe uma mensagem de erro
        echo "Erro: CNPJs selecionados não são um array válido";
    }
} else {
    // Se nenhum CNPJ foi enviado, exibe uma mensagem de erro
    echo "Erro: Nenhum CNPJ selecionado para exclusão";
}

require "../includes/desconectar.inc.php";
?>

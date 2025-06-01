<?php
// Carrega o arquivo de configuração
require_once '../app/config/config.php';

// Testa a conexão com o banco de dados
try {
    $conn = Banco::getConn();
    echo "<h1>Sistema de Controle de Estoque</h1>";
    echo "<p>Conexão com o banco de dados estabelecida com sucesso!</p>";
} catch (Exception $e) {
    echo "<h1>Erro</h1>";
    echo "<p>Não foi possível conectar ao banco de dados: " . $e->getMessage() . "</p>";
}
?>
<?php
// Carrega o arquivo de configuração
require_once '../app/config/config.php';
require_once '../app/controllers/AuthController.php';

// Inicia a sessão
Session::start();

// Verifica qual página deve ser carregada
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Instancia o controlador de autenticação
$auth = new AuthController();

// Roteamento básico
switch ($page) {
    case 'login':
        $auth->login();
        break;
        
    case 'cadastro':
        $auth->cadastro();
        break;
        
    case 'logout':
        $auth->logout();
        break;
        
    case 'home':
    default:
        // Verifica se o usuário está logado
        if (!AuthController::estaLogado()) {
            header('Location: index.php?page=login');
            exit;
        }
        
        // Exibe a página inicial
        include '../app/views/home.php';
        break;
}
?>
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
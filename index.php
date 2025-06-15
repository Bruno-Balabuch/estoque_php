<?php
session_start();

// Rotas que não precisam de autenticação
$public_routes = [
    'auth' => ['login', 'registro']
];

$controller = $_GET['controller'] ?? 'produto';
$action = $_GET['action'] ?? 'index';

// Verifica se o usuário está logado para rotas protegidas
if (!isset($_SESSION['usuario_id']) && 
    (!isset($public_routes[$controller]) || 
     !in_array($action, $public_routes[$controller]))) {
    header('Location: index.php?controller=auth&action=login');
    exit;
}

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    $controllerName = ucfirst($controller) . 'Controller';
    require_once "Controllers/{$controllerName}.php";

    $controllerInstance = new $controllerName();

    if($id) {
        $controllerInstance->$action($id);
    } else {
        $controllerInstance->$action();
    }
} else {
    ob_start();
    ?>
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mb-5">
            <h1 class="display-4 mb-3">Bem-vindo ao Sistema de Estoque</h1>
            <p class="lead text-muted">Gerencie seus produtos, categorias e fornecedores de forma simples e eficiente.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-box-seam text-primary" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title mt-3">Produtos</h5>
                    <p class="card-text text-muted">Gerencie seu inventário de produtos de forma eficiente.</p>
                    <a href="index.php?controller=produto&action=index" class="btn btn-primary btn-icon">
                        <i class="bi bi-arrow-right"></i> Acessar Produtos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-tags text-primary" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title mt-3">Categorias</h5>
                    <p class="card-text text-muted">Organize seus produtos em categorias específicas.</p>
                    <a href="index.php?controller=categoria&action=index" class="btn btn-primary btn-icon">
                        <i class="bi bi-arrow-right"></i> Acessar Categorias
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-building text-primary" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title mt-3">Fornecedores</h5>
                    <p class="card-text text-muted">Mantenha seus contatos com fornecedores organizados.</p>
                    <a href="index.php?controller=fornecedor&action=index" class="btn btn-primary btn-icon">
                        <i class="bi bi-arrow-right"></i> Acessar Fornecedores
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
    $content = ob_get_clean();
    require_once 'Views/layout.php';
}
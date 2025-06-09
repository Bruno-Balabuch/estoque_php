<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de Estoque</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Sistema de Controle de Estoque</h1>
            <div class="user-info">
                <span>Bem-vindo, <?php echo Session::get('usuario_nome'); ?></span>
                <a href="index.php?page=logout" class="btn btn-sm">Sair</a>
            </div>
        </header>
        
        <main>
            <div class="dashboard">
                <h2>Painel de Controle</h2>
                <p>Bem-vindo ao Sistema de Controle de Estoque.</p>
                
                <?php if (AuthController::eAdmin()): ?>
                <div class="admin-section">
                    <h3>Área do Administrador</h3>
                    <p>Você tem acesso a todas as funcionalidades do sistema.</p>
                </div>
                <?php endif; ?>
                
                <div class="menu">
                    <h3>Menu Principal</h3>
                    <ul>
                        <li><a href="#">Produtos</a></li>
                        <li><a href="#">Categorias</a></li>
                        <li><a href="#">Fornecedores</a></li>
                        <li><a href="#">Movimentações</a></li>
                        <?php if (AuthController::eAdmin()): ?>
                        <li><a href="#">Usuários</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </main>
        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> - Sistema de Controle de Estoque</p>
        </footer>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema de Controle de Estoque</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h2>Cadastro de Usuário</h2>
            
            <?php if (isset($erros) && !empty($erros)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($erros as $erro): ?>
                            <li><?php echo $erro; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form action="index.php?page=cadastro" method="post">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo isset($nome) ? $nome : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                    <small>A senha deve ter pelo menos 6 caracteres</small>
                </div>
                
                <div class="form-group">
                    <label for="confirmar_senha">Confirmar Senha:</label>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
                
                <div class="links">
                    <a href="index.php?page=login">Já tem uma conta? Faça login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Controle de Estoque</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h2>Login</h2>
            
            <?php if (isset($erro)): ?>
                <div class="alert alert-danger">
                    <?php echo $erro; ?>
                </div>
            <?php endif; ?>
            
            <?php if (Session::has('mensagem')): ?>
                <div class="alert alert-success">
                    <?php echo Session::get('mensagem'); ?>
                    <?php Session::remove('mensagem'); ?>
                </div>
            <?php endif; ?>
            
            <form action="index.php?page=login" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                
                <div class="form-group checkbox">
                    <input type="checkbox" id="lembrar" name="lembrar">
                    <label for="lembrar">Lembrar-me</label>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
                
                <div class="links">
                    <a href="index.php?page=cadastro">Não tem uma conta? Cadastre-se</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
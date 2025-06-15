<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Login</h2>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?php if (isset($erro)): ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?php echo $erro; ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="seu@email.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="lembrar_me" name="lembrar_me">
                            <label class="form-check-label" for="lembrar_me">Lembrar-me</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="index.php?controller=auth&action=registro" class="text-decoration-none">
                            <i class="bi bi-person-plus"></i> Criar nova conta
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i> Entrar
                        </button>
                    </div>
                    <div>
                        Email: teste@teste.com
                        Senha: 123
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
$title = "Login - Sistema de Estoque";
$content = ob_get_clean(); 
require 'Views/layout.php';
?>
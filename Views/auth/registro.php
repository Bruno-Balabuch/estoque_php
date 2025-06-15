<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Criar Conta</h2>
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
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="seu@email.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="index.php?controller=auth&action=login" class="text-decoration-none">
                            <i class="bi bi-arrow-left"></i> Voltar para login
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
$title = "Criar Conta - Sistema de Estoque";
$content = ob_get_clean(); 
require 'Views/layout.php';
?>
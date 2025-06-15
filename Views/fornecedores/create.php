<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Novo Fornecedor</h2>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="index.php?controller=fornecedor&action=store" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nome do Fornecedor</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">CNPJ</label>
                        <input type="text" name="cnpj" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php?controller=fornecedor&action=index" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
$title = "Novo Fornecedor - Sistema de Estoque";
$content = ob_get_clean(); 
require 'Views/layout.php';
?>
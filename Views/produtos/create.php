<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Novo Produto</h2>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="index.php?controller=produto&action=store" method="POST">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Nome do Produto</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Quantidade</label>
                            <input type="number" name="quantidade" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Preço</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="number" name="preco" class="form-control" step="0.01" required>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Categoria</label>
                            <select name="categoria_id" class="form-control" required>
                                <option value="">Selecione...</option>
                                <?php foreach($categorias as $categoria): ?>
                                    <option value="<?php echo $categoria['id']; ?>">
                                        <?php echo $categoria['nome']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Fornecedor</label>
                            <select name="fornecedor_id" class="form-control" required>
                                <option value="">Selecione...</option>
                                <?php foreach($fornecedores as $fornecedor): ?>
                                    <option value="<?php echo $fornecedor['id']; ?>">
                                        <?php echo $fornecedor['nome']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="index.php?controller=produto&action=index" class="btn btn-outline-secondary">
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
$title = "Novo Produto - Sistema de Estoque";
$content = ob_get_clean(); 
require 'Views/layout.php';
?>
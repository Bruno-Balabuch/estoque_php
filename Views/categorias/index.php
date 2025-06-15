<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Gerenciar Categorias</h2>
    <a href="index.php?controller=categoria&action=create" class="btn btn-primary btn-icon">
        <i class="bi bi-plus-lg"></i> Nova Categoria
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">ID</th>
                        <th>Nome</th>
                        <th class="text-end px-4">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categorias as $categoria): ?>
                    <tr>
                        <td class="px-4"><?php echo $categoria['id']; ?></td>
                        <td><?php echo $categoria['nome']; ?></td>
                        <td class="text-end px-4">
                            <a href="index.php?controller=categoria&action=edit&id=<?php echo $categoria['id']; ?>" 
                               class="btn btn-sm btn-outline-primary me-2">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="index.php?controller=categoria&action=delete&id=<?php echo $categoria['id']; ?>" 
                               class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
$title = "Categorias - Sistema de Estoque";
$content = ob_get_clean(); 
require 'Views/layout.php';
?>
<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Gerenciar Fornecedores</h2>
    <a href="index.php?controller=fornecedor&action=create" class="btn btn-primary btn-icon">
        <i class="bi bi-plus-lg"></i> Novo Fornecedor
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
                        <th>CNPJ</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th class="text-end px-4">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($fornecedores as $fornecedor): ?>
                    <tr>
                        <td class="px-4"><?php echo $fornecedor['id']; ?></td>
                        <td><?php echo $fornecedor['nome']; ?></td>
                        <td><?php echo $fornecedor['cnpj']; ?></td>
                        <td><?php echo $fornecedor['telefone']; ?></td>
                        <td><?php echo $fornecedor['email']; ?></td>
                        <td class="text-end px-4">
                            <a href="index.php?controller=fornecedor&action=edit&id=<?php echo $fornecedor['id']; ?>" 
                               class="btn btn-sm btn-outline-primary me-2">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="index.php?controller=fornecedor&action=delete&id=<?php echo $fornecedor['id']; ?>" 
                               class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('Tem certeza que deseja excluir este fornecedor?')">
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
$title = "Fornecedores - Sistema de Estoque";
$content = ob_get_clean(); 
require 'Views/layout.php';
?>
<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Produtos</h1>
        <p class="text-muted">Gerencie seu inventário de produtos</p>
    </div>
    <a href="index.php?controller=produto&action=create" class="btn btn-primary btn-icon">
        <i class="bi bi-plus-lg"></i> Novo Produto
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Categoria</th>
                        <th>Fornecedor</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produtos as $produto): ?>
                    <tr>
                        <td><?php echo $produto['id']; ?></td>
                        <td><?php echo $produto['nome']; ?></td>
                        <td><?php echo $produto['descricao']; ?></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $produto['quantidade']; ?></td>
                        <td><?php echo $produto['categoria_nome']; ?></td>
                        <td><?php echo $produto['fornecedor_nome']; ?></td>
                        <td>
                            <a href="index.php?controller=produto&action=edit&id=<?php echo $produto['id']; ?>" 
                               class="btn btn-sm btn-outline-primary me-2">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="index.php?controller=produto&action=delete&id=<?php echo $produto['id']; ?>" 
                               class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('Tem certeza que deseja excluir este produto?')">
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
$title = 'Produtos - Sistema de Estoque';
$content = ob_get_clean(); 
require_once 'Views/layout.php'; 
?>
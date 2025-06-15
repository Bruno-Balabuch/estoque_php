<?php
require_once 'Models/Produto.php';
require_once 'Models/Categoria.php';
require_once 'Models/Fornecedor.php';

class ProdutoController {
    public function index() {
        $produtos = Produto::findAll();
        include 'Views/produtos/index.php';
    }
    
    public function create() {
        $categorias = Categoria::findAll();
        $fornecedores = Fornecedor::findAll();
        include 'Views/produtos/create.php';
    }
    
    public function store() {
        $produto = new Produto();
        $produto->setNome($_POST['nome']);
        $produto->setDescricao($_POST['descricao']);
        $produto->setPreco($_POST['preco']);
        $produto->setQuantidade($_POST['quantidade']);
        $produto->setCategoriaId($_POST['categoria_id']);
        $produto->setFornecedorId($_POST['fornecedor_id']);
        
        if($produto->save()) {
            header('Location: index.php?controller=produto&action=index');
        }
    }
    
    public function edit($id) {
        $produto = Produto::findById($id);
        $categorias = Categoria::findAll();
        $fornecedores = Fornecedor::findAll();
        include 'Views/produtos/edit.php';
    }
    
    public function update($id) {
        $produto = new Produto();
        $produto->setId($id); // Adicionando esta linha
        $produto->setNome($_POST['nome']);
        $produto->setDescricao($_POST['descricao']);
        $produto->setPreco($_POST['preco']);
        $produto->setQuantidade($_POST['quantidade']);
        $produto->setCategoriaId($_POST['categoria_id']);
        $produto->setFornecedorId($_POST['fornecedor_id']);
        
        if($produto->save()) {
            header('Location: index.php?controller=produto&action=index');
        }
    }
    
    public function delete($id) {
        if(Produto::delete($id)) {
            header('Location: index.php?controller=produto&action=index');
        }
    }
}
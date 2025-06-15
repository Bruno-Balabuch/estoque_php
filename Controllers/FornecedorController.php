<?php
require_once 'Models/Fornecedor.php';

class FornecedorController {
    public function index() {
        $fornecedores = Fornecedor::findAll();
        include 'Views/fornecedores/index.php';
    }
    
    public function create() {
        include 'Views/fornecedores/create.php';
    }
    
    public function store() {
        $fornecedor = new Fornecedor();
        $fornecedor->setNome($_POST['nome']);
        $fornecedor->setCnpj($_POST['cnpj']);
        $fornecedor->setTelefone($_POST['telefone']);
        $fornecedor->setEmail($_POST['email']);
        
        if($fornecedor->save()) {
            header('Location: index.php?controller=fornecedor&action=index');
        }
    }
    
    public function edit($id) {
        $fornecedor = Fornecedor::findById($id);
        include 'Views/fornecedores/edit.php';
    }
    
    public function update($id) {
        $fornecedor = new Fornecedor();
        $fornecedor->setId($id); // Adicionando esta linha
        $fornecedor->setNome($_POST['nome']);
        $fornecedor->setCnpj($_POST['cnpj']);
        $fornecedor->setTelefone($_POST['telefone']);
        $fornecedor->setEmail($_POST['email']);
        
        if($fornecedor->save()) {
            header('Location: index.php?controller=fornecedor&action=index');
        }
    }
    
    public function delete($id) {
        if(Fornecedor::delete($id)) {
            header('Location: index.php?controller=fornecedor&action=index');
        }
    }
}
<?php
require_once 'Models/Categoria.php';

class CategoriaController {
    public function index() {
        $categorias = Categoria::findAll();
        include 'Views/categorias/index.php';
    }
    
    public function create() {
        include 'Views/categorias/create.php';
    }
    
    public function store() {
        $categoria = new Categoria();
        $categoria->setNome($_POST['nome']);
        
        if($categoria->save()) {
            header('Location: index.php?controller=categoria&action=index');
        }
    }
    
    public function edit($id) {
        $categoria = Categoria::findById($id);
        include 'Views/categorias/edit.php';
    }
    
    public function update($id) {
        $categoria = new Categoria();
        $categoria->setId($id); // Adicionando esta linha
        $categoria->setNome($_POST['nome']);
        
        if($categoria->save()) {
            header('Location: index.php?controller=categoria&action=index');
        }
    }
    
    public function delete($id) {
        if(Categoria::delete($id)) {
            header('Location: index.php?controller=categoria&action=index');
        }
    }
}
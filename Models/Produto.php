<?php
require_once 'Config/banco.php';

class Produto {
    private $id;
    private $nome;
    private $descricao;
    private $preco;
    private $quantidade;
    private $categoria_id;
    private $fornecedor_id;
    
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getDescricao() { return $this->descricao; }
    public function getPreco() { return $this->preco; }
    public function getQuantidade() { return $this->quantidade; }
    public function getCategoriaId() { return $this->categoria_id; }
    public function getFornecedorId() { return $this->fornecedor_id; }
    
    public function setId($id) { $this->id = $id; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setDescricao($descricao) { $this->descricao = $descricao; }
    public function setPreco($preco) { $this->preco = $preco; }
    public function setQuantidade($quantidade) { $this->quantidade = $quantidade; }
    public function setCategoriaId($categoria_id) { $this->categoria_id = $categoria_id; }
    public function setFornecedorId($fornecedor_id) { $this->fornecedor_id = $fornecedor_id; }
    
    public function save() {
        $conn = Banco::getConn();
        
        if (!isset($this->id)) {
            $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco, quantidade, categoria_id, fornecedor_id) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdiis", $this->nome, $this->descricao, $this->preco, $this->quantidade, $this->categoria_id, $this->fornecedor_id);
        } else {
            $stmt = $conn->prepare("UPDATE produtos SET nome = ?, descricao = ?, preco = ?, quantidade = ?, categoria_id = ?, fornecedor_id = ? WHERE id = ?");
            $stmt->bind_param("ssdiisi", $this->nome, $this->descricao, $this->preco, $this->quantidade, $this->categoria_id, $this->fornecedor_id, $this->id);
        }
        
        return $stmt->execute();
    }
    
    public static function findAll() {
        $conn = Banco::getConn();
        $result = $conn->query("SELECT p.*, c.nome as categoria_nome, f.nome as fornecedor_nome 
                              FROM produtos p 
                              LEFT JOIN categorias c ON p.categoria_id = c.id 
                              LEFT JOIN fornecedores f ON p.fornecedor_id = f.id");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public static function findById($id) {
        $conn = Banco::getConn();
        $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public static function delete($id) {
        $conn = Banco::getConn();
        $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
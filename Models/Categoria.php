<?php
require_once 'Config/banco.php';

class Categoria {
    private $id;
    private $nome;
    
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }

    public function setId($id) { $this->id = $id; }
    public function setNome($nome) { $this->nome = $nome; }
    
    public function save() {
        $conn = Banco::getConn();
        
        if (!isset($this->id)) {
            $stmt = $conn->prepare("INSERT INTO categorias (nome) VALUES (?)");
            $stmt->bind_param("s", $this->nome);
        } else {
            $stmt = $conn->prepare("UPDATE categorias SET nome = ? WHERE id = ?");
            $stmt->bind_param("si", $this->nome, $this->id);
        }
        
        return $stmt->execute();
    }
    
    public static function findAll() {
        $conn = Banco::getConn();
        $result = $conn->query("SELECT * FROM categorias");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public static function findById($id) {
        $conn = Banco::getConn();
        $stmt = $conn->prepare("SELECT * FROM categorias WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public static function delete($id) {
        $conn = Banco::getConn();
        $stmt = $conn->prepare("DELETE FROM categorias WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
<?php
require_once 'Config/banco.php';

class Fornecedor {
    private $id;
    private $nome;
    private $cnpj;
    private $telefone;
    private $email;
    
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getCnpj() { return $this->cnpj; }
    public function getTelefone() { return $this->telefone; }
    public function getEmail() { return $this->email; }
    
    public function setId($id) { $this->id = $id; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setCnpj($cnpj) { $this->cnpj = $cnpj; }
    public function setTelefone($telefone) { $this->telefone = $telefone; }
    public function setEmail($email) { $this->email = $email; }
    
    public function save() {
        $conn = Banco::getConn();
        
        if (!isset($this->id)) {
            $stmt = $conn->prepare("INSERT INTO fornecedores (nome, cnpj, telefone, email) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $this->nome, $this->cnpj, $this->telefone, $this->email);
        } else {
            $stmt = $conn->prepare("UPDATE fornecedores SET nome = ?, cnpj = ?, telefone = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $this->nome, $this->cnpj, $this->telefone, $this->email, $this->id);
        }
        
        return $stmt->execute();
    }
    
    public static function findAll() {
        $conn = Banco::getConn();
        $result = $conn->query("SELECT * FROM fornecedores");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public static function findById($id) {
        $conn = Banco::getConn();
        $stmt = $conn->prepare("SELECT * FROM fornecedores WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public static function delete($id) {
        $conn = Banco::getConn();
        $stmt = $conn->prepare("DELETE FROM fornecedores WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
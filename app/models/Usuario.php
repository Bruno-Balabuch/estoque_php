<?php
class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $nivel;
    private $data_criacao;
    private $data_atualizacao;
    
    // Método para cadastrar um novo usuário
    public function cadastrar($nome, $email, $senha, $nivel = 'usuario') {
        $conn = Banco::getConn();
        
        // Verifica se o email já existe
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return false; // Email já cadastrado
        }
        
        // Hash da senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        
        // Insere o novo usuário
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, nivel) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $email, $senha_hash, $nivel);
        
        if ($stmt->execute()) {
            $this->id = $conn->insert_id;
            $this->nome = $nome;
            $this->email = $email;
            $this->nivel = $nivel;
            return true;
        }
        
        return false;
    }
    
    // Método para autenticar um usuário
    public function login($email, $senha) {
        $conn = Banco::getConn();
        
        $stmt = $conn->prepare("SELECT id, nome, email, senha, nivel FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $usuario = $result->fetch_assoc();
            
            if (password_verify($senha, $usuario['senha'])) {
                $this->id = $usuario['id'];
                $this->nome = $usuario['nome'];
                $this->email = $usuario['email'];
                $this->nivel = $usuario['nivel'];
                return true;
            }
        }
        
        return false;
    }
    
    // Método para buscar um usuário pelo ID
    public function buscarPorId($id) {
        $conn = Banco::getConn();
        
        $stmt = $conn->prepare("SELECT id, nome, email, nivel, data_criacao, data_atualizacao FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $usuario = $result->fetch_assoc();
            $this->id = $usuario['id'];
            $this->nome = $usuario['nome'];
            $this->email = $usuario['email'];
            $this->nivel = $usuario['nivel'];
            $this->data_criacao = $usuario['data_criacao'];
            $this->data_atualizacao = $usuario['data_atualizacao'];
            return true;
        }
        
        return false;
    }
    
    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getNivel() {
        return $this->nivel;
    }
}
?>
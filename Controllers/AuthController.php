<?php
class AuthController {
    private $db;

    public function __construct() {
        require_once 'Config/banco.php';
        $this->db = Banco::getConn();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $stmt = $this->db->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ? LIMIT 1");
            $stmt->execute([$email]);
            $stmt->store_result();
            $stmt->bind_result($id, $nome, $hash_senha);
            $stmt->fetch();

            if ($stmt->num_rows > 0 && password_verify($senha, $hash_senha)) {
                session_start();
                $_SESSION['usuario_id'] = $id;
                $_SESSION['usuario_nome'] = $nome;

                if (isset($_POST['lembrar_me'])) {
                    setcookie('usuario_email', $email, time() + (30 * 24 * 60 * 60), '/'); // 30 dias
                }

                header('Location: index.php');
                exit;
            }
            $erro = "Email ou senha inválidos";
        }

        require 'Views/auth/login.php';
    }

    public function registro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            if ($stmt->execute([$nome, $email, $senha])) {
                header('Location: index.php?controller=auth&action=login');
                exit;
            }
            $erro = "Erro ao registrar usuário";
        }

        require 'Views/auth/registro.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        setcookie('usuario_email', '', time() - 3600, '/');
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}
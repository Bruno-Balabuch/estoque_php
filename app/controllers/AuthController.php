<?php
require_once '../app/models/Usuario.php';
require_once '../app/core/Session.php';

class AuthController {
    private $usuario;
    
    public function __construct() {
        $this->usuario = new Usuario();
    }
    
    // Método para processar o login
    public function login() {
        // Se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'];
            $lembrar = isset($_POST['lembrar']) ? true : false;
            
            if ($this->usuario->login($email, $senha)) {
                // Cria a sessão do usuário
                Session::set('usuario_id', $this->usuario->getId());
                Session::set('usuario_nome', $this->usuario->getNome());
                Session::set('usuario_nivel', $this->usuario->getNivel());
                Session::set('logado', true);
                
                // Se marcou "lembrar-me", cria um cookie
                if ($lembrar) {
                    $token = bin2hex(random_bytes(16)); // Gera um token aleatório
                    Session::setCookie('lembrar_token', $token, 30); // Cookie válido por 30 dias
                    Session::setCookie('usuario_email', $email, 30);
                }
                
                // Redireciona para a página inicial
                header('Location: index.php');
                exit;
            } else {
                $erro = "Email ou senha incorretos";
                include '../app/views/auth/login.php';
            }
        } else {
            // Verifica se existe um cookie de "lembrar-me"
            $email = Session::getCookie('usuario_email');
            include '../app/views/auth/login.php';
        }
    }
    
    // Método para processar o cadastro
    public function cadastro() {
        // Se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'];
            $confirmar_senha = $_POST['confirmar_senha'];
            
            // Validações básicas
            $erros = [];
            
            if (empty($nome)) {
                $erros[] = "O nome é obrigatório";
            }
            
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erros[] = "Email inválido";
            }
            
            if (empty($senha)) {
                $erros[] = "A senha é obrigatória";
            } elseif (strlen($senha) < 6) {
                $erros[] = "A senha deve ter pelo menos 6 caracteres";
            }
            
            if ($senha !== $confirmar_senha) {
                $erros[] = "As senhas não conferem";
            }
            
            if (empty($erros)) {
                if ($this->usuario->cadastrar($nome, $email, $senha)) {
                    // Redireciona para a página de login com mensagem de sucesso
                    Session::set('mensagem', 'Cadastro realizado com sucesso! Faça login para continuar.');
                    header('Location: index.php?page=login');
                    exit;
                } else {
                    $erros[] = "Erro ao cadastrar usuário. Email já pode estar em uso.";
                }
            }
            
            // Se houver erros, exibe o formulário novamente
            include '../app/views/auth/cadastro.php';
        } else {
            include '../app/views/auth/cadastro.php';
        }
    }
    
    // Método para fazer logout
    public function logout() {
        Session::destroy();
        Session::removeCookie('lembrar_token');
        Session::removeCookie('usuario_email');
        
        header('Location: index.php');
        exit;
    }
    
    // Método para verificar se o usuário está logado
    public static function estaLogado() {
        return Session::has('logado') && Session::get('logado') === true;
    }
    
    // Método para verificar se o usuário é admin
    public static function eAdmin() {
        return self::estaLogado() && Session::get('usuario_nivel') === 'admin';
    }
}
?>
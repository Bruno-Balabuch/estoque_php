<?php
class Session {
    // Iniciar a sessão
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    // Definir uma variável de sessão
    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }
    
    
    // Obter uma variável de sessão
    public static function get($key) {
        self::start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    
    // Verificar se uma variável de sessão existe
    public static function has($key) {
        self::start();
        return isset($_SESSION[$key]);
    }
    
    // Remover uma variável de sessão
    public static function remove($key) {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    
    // Destruir a sessão
    public static function destroy() {
        self::start();
        session_unset();
        session_destroy();
    }
    
    // Definir um cookie
    public static function setCookie($name, $value, $expiry = 30) {
        $expiry_time = time() + (86400 * $expiry); // 86400 = 1 dia
        setcookie($name, $value, $expiry_time, '/');
    }
    
    // Obter um cookie
    public static function getCookie($name) {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }
    
    // Remover um cookie
    public static function removeCookie($name) {
        if (isset($_COOKIE[$name])) {
            setcookie($name, '', time() - 3600, '/');
        }
    }
}
?>
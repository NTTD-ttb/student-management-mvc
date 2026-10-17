<?php
// app/controllers/AuthController.php
require_once __DIR__ . '/../../config/DataBase.php';
require_once __DIR__ . '/../models/UserModel.php';
class AuthController {
    private $userModel;
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $db = new DataBase();
        $this->userModel = new UserModel($db);
    }
    public function login() {
        if (isset($_SESSION['user'])) {
            header("Location: index.php?action=students");
            exit();
        }
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $user = $this->userModel->authenticate($username, $password);
            if ($user) {
                $_SESSION['user'] = [
                    'username' => $user['username'],
                    'role'     => $user['role']
                ];
                header("Location: index.php?action=students");
                exit();
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không chính xác!";
            }
        }
        require_once __DIR__ . '/../views/auth/login.php';
    }
    public function logout() {
        unset($_SESSION['user']);
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }
}
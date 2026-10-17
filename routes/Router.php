<?php
// routes/Router.php
class Router {
    private $routes = [];
    public function __construct() {
        // --- 1. Nhóm Xác thực (Auth) ---
        $this->addRoute('login',          'AuthController', 'login');
        $this->addRoute('logout',         'AuthController', 'logout');
        // --- 2. Nhóm Quản lý Sinh viên ---
        $this->addRoute('students',       'StudentController', 'index');
        $this->addRoute('student-detail', 'StudentController', 'detail');
        $this->addRoute('student-create', 'StudentController', 'create');
        $this->addRoute('student-edit',   'StudentController', 'edit');
        $this->addRoute('student-delete', 'StudentController', 'delete');
    }
    private function addRoute($action, $controller, $method) {
        $this->routes[$action] = [
            'controller' => $controller,
            'method'     => $method
        ];
    }
/* Bộ điều hướng (Router / Dispatcher): Đọc URL, xác định gọi Controller, chạy phương thức (method) và truyền tham số cần thiết */
    public function dispatch() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'students';
        if (array_key_exists($action, $this->routes)) {
            $controllerName = $this->routes[$action]['controller'];
            $methodName     = $this->routes[$action]['method'];
            $controllerFile = __DIR__ . "/../app/controllers/" . $controllerName . ".php";
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                $controllerObject = new $controllerName();
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                if ($id !== null) {
                    $controllerObject->$methodName($id);
                } else {
                    $controllerObject->$methodName();
                }
            } else {
                die("Lỗi hệ thống: Không tìm thấy file Controller: " . $controllerName);
            }
        } else {
            http_response_code(404);
            echo "<h1 style='text-align:center; margin-top:50px;'>404 - Trang bạn yêu cầu không tồn tại!</h1>";
        }
    }
}
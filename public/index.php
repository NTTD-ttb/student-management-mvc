<?php
// public/index.php
// 1. Khởi tạo Session hệ thống
session_start();
// 2. Nạp Lớp Router
require_once __DIR__ . '/../routes/Router.php';
// 3. Khởi tạo và thực thi Router
$router = new Router();
$router->dispatch();
?>
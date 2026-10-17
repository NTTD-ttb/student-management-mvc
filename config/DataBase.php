<?php
// config/DataBase.php
class DataBase {
    private $pdo;
    public function __construct() {
        try {
            $dsn = "mysql:host=localhost;dbname=student_db;charset=utf8mb4";
            $this->pdo = new PDO($dsn, "root", "", [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false
            ]);
        } catch (PDOException $e) {
            die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
        }
    }
    public function getConnection() {
        return $this->pdo;
    }
}
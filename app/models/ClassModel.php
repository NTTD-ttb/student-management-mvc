<?php
// app/models/ClassModel.php

// trongn model chỉ xử lý đúng thực hinenej j sai thực hiện gì thoi
require_once __DIR__ . '/../../config/DataBase.php';
class ClassModel {
    public $class_code;
    public $class_name;
    public $major_code;
    private $db;
    public function __construct(DataBase $db) {
        $this->db = $db;
    }
    public function all() {
        $pdo = $this->db->getConnection();
        $sql = "SELECT c.*, m.major_name 
                FROM classes c 
                JOIN majors m ON c.major_code = m.major_code 
                ORDER BY c.class_code ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function findById($class_code) {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM classes WHERE class_code = :code LIMIT 1");
        $stmt->bindValue(':code', $class_code, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
}
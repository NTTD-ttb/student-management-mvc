<?php
// app/models/MajorModel.php
require_once __DIR__ . '/../../config/DataBase.php';
class MajorModel {
    public $major_code;
    public $major_name;
    private $db;
    public function __construct(DataBase $db) {
        $this->db = $db;
    }
    public function all() {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM majors ORDER BY major_name ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
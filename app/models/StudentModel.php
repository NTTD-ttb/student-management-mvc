<?php
// app/models/StudentModel.php
require_once __DIR__ . '/../../config/DataBase.php';
class StudentModel {
    public $student_id;
    public $fullname;
    public $email;
    public $phone;
    public $class_code;
    public $class_name;
    public $major_name;
    private $db;
    public function __construct(DataBase $db, $id = null, $fullname = '', $email = '', $phone = '', $class_code = '') {
        $this->db = $db;
        $this->student_id = $id;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->phone = $phone;
        $this->class_code = $class_code;
    }
    public function all($class_code_filter = null) {
        $pdo = $this->db->getConnection();
        $sql = "SELECT s.*, c.class_name, m.major_name 
                FROM students s
                JOIN classes c ON s.class_code = c.class_code
                JOIN majors m ON c.major_code = m.major_code";       
        if ($class_code_filter) {
            $sql .= " WHERE s.class_code = :class_code";
        }
        $sql .= " ORDER BY s.student_id DESC";
        $stmt = $pdo->prepare($sql);
        if ($class_code_filter) {
            $stmt->bindValue(':class_code', $class_code_filter, PDO::PARAM_STR);
        }
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $list = [];
        foreach ($rows as $row) {
            $st = new StudentModel($this->db, $row['student_id'], $row['fullname'], $row['email'], $row['phone'], $row['class_code']);
            $st->class_name = $row['class_name'];
            $st->major_name = $row['major_name'];
            $list[] = $st;
        }
        return $list;
    }
    public function findById($id) {
        $pdo = $this->db->getConnection();
        $sql = "SELECT s.*, c.class_name, m.major_name 
                FROM students s
                JOIN classes c ON s.class_code = c.class_code
                JOIN majors m ON c.major_code = m.major_code
                WHERE s.student_id = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        if (!$row) return null;
        $st = new StudentModel($this->db, $row['student_id'], $row['fullname'], $row['email'], $row['phone'], $row['class_code']);
        $st->class_name = $row['class_name'];
        $st->major_name = $row['major_name'];
        return $st;
    }
    public function save($is_update = false) {
        $pdo = $this->db->getConnection();
        if ($is_update) {
            $sql = "UPDATE students SET fullname = :fullname, email = :email, phone = :phone, class_code = :class_code WHERE student_id = :id";
        } else {
            $sql = "INSERT INTO students (student_id, fullname, email, phone, class_code) VALUES (:id, :fullname, :email, :phone, :class_code)";
        }
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $this->student_id, PDO::PARAM_STR);
        $stmt->bindValue(':fullname', $this->fullname, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $stmt->bindValue(':class_code', $this->class_code, PDO::PARAM_STR);
        return $stmt->execute();
    }
    public function delete() {
        if (!$this->student_id) return false;
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare("DELETE FROM students WHERE student_id = :id");
        $stmt->bindValue(':id', $this->student_id, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
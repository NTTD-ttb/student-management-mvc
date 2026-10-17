<?php
// app/controllers/StudentController.php
require_once __DIR__ . '/../../config/DataBase.php';
require_once __DIR__ . '/../models/StudentModel.php';
require_once __DIR__ . '/../models/ClassModel.php';
class StudentController {
    private $db;
    private $studentModel;
    private $classModel;
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit();
        }
        $this->db = new DataBase();
        $this->studentModel = new StudentModel($this->db);
        $this->classModel = new ClassModel($this->db);
    }
    public function index() {
        $selected_class = isset($_GET['class_code']) ? $_GET['class_code'] : null;
        $students = $this->studentModel->all($selected_class);
        $classes  = $this->classModel->all();
        require_once __DIR__ . '/../views/students/index.php';
    }
    public function detail($id) {
        $student = $this->studentModel->findById($id);
        if (!$student) {
            header("Location: index.php?action=students");
            exit();
        }
        require_once __DIR__ . '/../views/students/detail.php';
    }
    public function create() {
        if ($_SESSION['user']['role'] !== 'admin') {
            die("<h3 style='color:red; text-align:center;'>Truy cập bị từ chối: Bạn không có quyền thực hiện chức năng này!</h3>");
        }
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $student_id = trim($_POST['student_id']);
            $fullname   = trim($_POST['fullname']);
            $email      = trim($_POST['email']);
            $phone      = trim($_POST['phone']);
            $class_code = trim($_POST['class_code']);

            $existing = $this->studentModel->findById($student_id);
            if ($existing) {
                $error = "Mã số sinh viên này đã tồn tại!";
            } else {
                $newStudent = new StudentModel($this->db, $student_id, $fullname, $email, $phone, $class_code);
                if ($newStudent->save(false)) {
                    header("Location: index.php?action=students&class_code=" . $class_code);
                    exit();
                } else {
                    $error = "Thêm mới sinh viên thất bại!";
                }
            }
        }
        $classes = $this->classModel->all();
        require_once __DIR__ . '/../views/students/create.php';
    }
    public function edit($id) {
        if ($_SESSION['user']['role'] !== 'admin') {
            die("<h3 style='color:red; text-align:center;'>Truy cập bị từ chối: Bạn không có quyền thực hiện chức năng này!</h3>");
        }
        $student = $this->studentModel->findById($id);
        if (!$student) {
            header("Location: index.php?action=students");
            exit();
        }
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $student->fullname   = trim($_POST['fullname']);
            $student->email      = trim($_POST['email']);
            $student->phone      = trim($_POST['phone']);
            $student->class_code = trim($_POST['class_code']);
            if ($student->save(true)) {
                header("Location: index.php?action=students&class_code=" . $student->class_code);
                exit();
            } else {
                $error = "Cập nhật sinh viên thất bại!";
            }
        }
        $classes = $this->classModel->all();
        require_once __DIR__ . '/../views/students/edit.php';
    }
    public function delete($id) {
        if ($_SESSION['user']['role'] !== 'admin') {
            die("<h3 style='color:red; text-align:center;'>Truy cập bị từ chối: Bạn không có quyền thực hiện chức năng này!</h3>");
        }
        $student = $this->studentModel->findById($id);
        if ($student) {
            $class_code = $student->class_code;
            $student->delete();
            header("Location: index.php?action=students&class_code=" . $class_code);
            exit();
        }
        header("Location: index.php?action=students");
        exit();
    }
}
<?php
require_once ROOT_PATH . 'models/Student.php';

class StudentController {
    private $studentModel;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->studentModel = new Student($db);
    }

    public function show($id) {
        $student = $this->studentModel->getById($id);
        if (!$student) {
            return null; // Trả về null nếu không tìm thấy sinh viên
        }
        return $student;
    }

    public function store($data) {
        if ($this->studentModel->create($data)) {
            header("Location: index.php");
            exit();
        }
    }

    public function edit($id) {
        return $this->studentModel->getById($id);
    }

    public function update($id, $data, $files) {
        if ($this->studentModel->update($id, $data, $files)) {
            header("Location: index.php");
            exit();
        } else {
            die("Cập nhật thất bại!");
        }
    }
    

    public function destroy($id) {
        if ($this->studentModel->delete($id)) {
            header("Location: index.php");
            exit();
        }
    }
}
?>

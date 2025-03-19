<?php
require_once ROOT_PATH . 'models/Course.php';

class CourseController {
    private $courseModel;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->courseModel = new Course($db);
    }

    // Lấy danh sách học phần
    public function index() {
        return $this->courseModel->getAll();
    }

    // Xử lý đăng ký học phần
    public function register($MaSV, $MaHP) {
        return $this->courseModel->register($MaSV, $MaHP);
    }
}
?>

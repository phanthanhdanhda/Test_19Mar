<?php
require_once ROOT_PATH . 'config/database.php';

class Course {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả học phần
    public function getAll() {
        $sql = "SELECT * FROM HocPhan";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Đăng ký học phần
    public function register($MaSV, $MaHP) {
        $sql = "INSERT INTO DangKy (MaSV, MaHP) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $MaSV, $MaHP);
        return $stmt->execute();
    }
}
?>

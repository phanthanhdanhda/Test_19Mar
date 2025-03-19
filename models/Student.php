<?php
require_once ROOT_PATH . 'config/Database.php';

class Student {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Thêm sinh viên
    public function create($data) {
        $hinh = $this->uploadImage($_FILES['Hinh']);

        $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", 
            $data['MaSV'], 
            $data['HoTen'], 
            $data['GioiTinh'], 
            $data['NgaySinh'], 
            $hinh, 
            $data['MaNganh']
        );
        return $stmt->execute();
    }

    // Lấy thông tin sinh viên theo ID
    public function getById($id) {
        $sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Cập nhật sinh viên
    public function update($id, $data, $files) {
        $oldStudent = $this->getById($id);
    
        // Xử lý ảnh: nếu có ảnh mới thì cập nhật, nếu không thì giữ ảnh cũ
        $hinh = (!empty($files['Hinh']['name'])) ? $this->uploadImage($files['Hinh'], $oldStudent['Hinh']) : $oldStudent['Hinh'];
    
        $sql = "UPDATE SinhVien SET HoTen=?, GioiTinh=?, NgaySinh=?, Hinh=?, MaNganh=? WHERE MaSV=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", 
            $data['HoTen'], 
            $data['GioiTinh'], 
            $data['NgaySinh'], 
            $hinh, 
            $data['MaNganh'], 
            $id
        );
        return $stmt->execute();
    }
    

    // Xóa sinh viên
    public function delete($id) {
        $oldStudent = $this->getById($id);
        if ($oldStudent && $oldStudent['Hinh']) {
            @unlink(ROOT_PATH . 'uploads/' . $oldStudent['Hinh']);
        }

        $sql = "DELETE FROM SinhVien WHERE MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    // Xử lý upload hình ảnh
    private function uploadImage($file, $oldImage = null) {
        if (!empty($file['name'])) {
            $uploadDir = ROOT_PATH . 'uploads/';
            $fileName = time() . '_' . basename($file['name']);
            $targetPath = $uploadDir . $fileName;
    
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                // Xóa ảnh cũ nếu có
                if ($oldImage && file_exists($uploadDir . $oldImage)) {
                    unlink($uploadDir . $oldImage);
                }
                return $fileName;
            }
        }
        return $oldImage; // Giữ ảnh cũ nếu không có ảnh mới
    }
    
}
?>

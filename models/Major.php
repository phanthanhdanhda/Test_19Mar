<?php
require_once ROOT_PATH . 'config/Database.php';

class Major {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM NganhHoc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($MaNganh) {
        $query = "SELECT * FROM NganhHoc WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $MaNganh);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($data) {
        $query = "INSERT INTO NganhHoc (MaNganh, TenNganh) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $data['MaNganh'], $data['TenNganh']);
        return $stmt->execute();
    }

    public function update($data) {
        $query = "UPDATE NganhHoc SET TenNganh = ? WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $data['TenNganh'], $data['MaNganh']);
        return $stmt->execute();
    }

    public function delete($MaNganh) {
        $query = "DELETE FROM NganhHoc WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $MaNganh);
        return $stmt->execute();
    }
}

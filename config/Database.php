<?php
class Database {
    private $host = "localhost"; // Đổi nếu cần
    private $user = "root"; // Username MySQL (XAMPP mặc định là "root")
    private $pass = ""; // Mật khẩu MySQL (XAMPP mặc định là rỗng)
    private $dbname = "Test1"; // Đổi thành tên database của bạn
    private $conn;

    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}
?>

<?php require_once __DIR__ . '/../../config.php'; // Load config trước

require_once ROOT_PATH . 'views/layout/header.php'; // Sau đó mới gọi header

require_once ROOT_PATH . 'models/Student.php';
require_once ROOT_PATH . 'controllers/StudentController.php';

$studentController = new StudentController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentController->store($_POST);
}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Test1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Danh sách sinh viên</h2>
        <a href="create.php" class="btn btn-primary mb-3">Thêm sinh viên</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình</th>
                    <th>Ngành Học</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM SinhVien";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['MaSV'] . "</td>";
                    echo "<td>" . $row['HoTen'] . "</td>";
                    echo "<td>" . $row['GioiTinh'] . "</td>";
                    echo "<td>" . $row['NgaySinh'] . "</td>";

                    // Sửa lỗi hiển thị hình ảnh
                    $imagePath = !empty($row['Hinh']) ? BASE_URL . 'uploads/' . $row['Hinh'] : BASE_URL . 'uploads/default.png';
                    echo "<td><img src='$imagePath' alt='Hình SV' style='width: 80px; height: auto;'></td>";

                    echo "<td>" . $row['MaNganh'] . "</td>";
                    echo "<td>
                            <a href='detail.php?MaSV=" . $row['MaSV'] . "' class='btn btn-info btn-sm'>Chi tiết</a>
                            <a href='edit.php?MaSV=" . $row['MaSV'] . "' class='btn btn-warning btn-sm'>Sửa</a>
                            <a href='delete.php?MaSV=" . $row['MaSV'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Xóa</a>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php $conn->close(); ?>

<?php require_once ROOT_PATH . 'views/layout/footer.php'; ?>
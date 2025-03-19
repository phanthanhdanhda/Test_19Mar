<?php
require_once __DIR__ . '/../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $MaHP = $_POST['MaHP'];
    header("Location: process_register.php?MaSV=$MaSV&MaHP=$MaHP");
    exit();
}

$MaHP = isset($_GET['MaHP']) ? $_GET['MaHP'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập để đăng ký</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Nhập Mã Sinh Viên để đăng ký học phần</h2>
        <form method="post">
            <input type="hidden" name="MaHP" value="<?= htmlspecialchars($MaHP) ?>">
            <div class="mb-3">
                <label class="form-label">Mã Sinh Viên</label>
                <input type="text" name="MaSV" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Xác nhận</button>
            <a href="index.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>

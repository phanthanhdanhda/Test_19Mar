<?php 
require_once __DIR__ . '/../../config.php';
require_once ROOT_PATH . 'views/layout/header.php'; 
require_once ROOT_PATH . 'controllers/StudentController.php';

$studentController = new StudentController();
$student = null;

if (isset($_GET['MaSV'])) {
    $student = $studentController->show($_GET['MaSV']);
}

if (!$student) {
    die("Sinh viên không tồn tại.");
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Chi tiết Sinh Viên</h2>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?= htmlspecialchars($student['HoTen']) ?></h4>
            <p><strong>Mã SV:</strong> <?= htmlspecialchars($student['MaSV']) ?></p>
            <p><strong>Giới Tính:</strong> <?= htmlspecialchars($student['GioiTinh']) ?></p>
            <p><strong>Ngày Sinh:</strong> <?= htmlspecialchars($student['NgaySinh']) ?></p>
            
            <!-- Hiển thị hình ảnh với đường dẫn đầy đủ -->
            <p><strong>Hình:</strong> 
                <img src="<?= BASE_URL . 'uploads/' . htmlspecialchars($student['Hinh']) ?>" alt="Hình Sinh Viên" width="100">
            </p>

            <!-- Hiển thị tên ngành học thay vì mã ngành -->
            <p><strong>Ngành Học:</strong> <?= isset($student['MaNganh']) ? htmlspecialchars($student['MaNganh']) : 'Không xác định' ?></p>

            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</div>


<?php require_once ROOT_PATH . 'views/layout/footer.php'; ?>

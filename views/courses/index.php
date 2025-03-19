<?php
require_once __DIR__ . '/../../config.php';
require_once ROOT_PATH . 'controllers/CourseController.php';

$courseController = new CourseController();
$courses = $courseController->index();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Danh sách Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Danh sách Học Phần</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã HP</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?= htmlspecialchars($course['MaHP']) ?></td>
                        <td><?= htmlspecialchars($course['TenHP']) ?></td>
                        <td><?= htmlspecialchars($course['SoTinChi']) ?></td>
                        <td>
                            <a href="register.php?MaHP=<?= urlencode($course['MaHP']) ?>" class="btn btn-primary btn-sm">Đăng ký</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="<?= BASE_URL ?>index.php" class="btn btn-secondary">Quay lại</a>
    </div>
</body>
</html>

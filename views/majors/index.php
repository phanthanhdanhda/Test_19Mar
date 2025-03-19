<?php 
require_once __DIR__ . '/../../config.php';
require_once ROOT_PATH . 'views/layout/header.php'; 
require_once ROOT_PATH . 'controllers/MajorController.php';

$majorController = new MajorController();
$majors = $majorController->index();
?>

<div class="container mt-5">
    <h2 class="mb-4">Quản lý Ngành Học</h2>
    <a href="create.php" class="btn btn-success mb-3">Thêm Ngành Học</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Ngành</th>
                <th>Tên Ngành</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($majors as $major) : ?>
                <tr>
                    <td><?= htmlspecialchars($major['MaNganh']) ?></td>
                    <td><?= htmlspecialchars($major['TenNganh']) ?></td>
                    <td>
                        <a href="edit.php?MaNganh=<?= $major['MaNganh'] ?>" class="btn btn-warning">Sửa</a>
                        <a href="delete.php?MaNganh=<?= $major['MaNganh'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once ROOT_PATH . 'views/layout/footer.php'; ?>

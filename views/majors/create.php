<?php 
require_once __DIR__ . '/../../config.php';
require_once ROOT_PATH . 'views/layout/header.php'; 
require_once ROOT_PATH . 'controllers/MajorController.php';

$majorController = new MajorController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $majorController->store($_POST);
    header("Location: index.php");
    exit();
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Thêm Ngành Học</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Mã Ngành</label>
            <input type="text" name="MaNganh" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tên Ngành</label>
            <input type="text" name="TenNganh" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="index.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php require_once ROOT_PATH . 'views/layout/footer.php'; ?>

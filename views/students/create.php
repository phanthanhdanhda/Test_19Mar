<?php
require_once __DIR__ . '/../../config.php';
require_once ROOT_PATH . 'views/layout/header.php';
require_once ROOT_PATH . 'controllers/StudentController.php';
require_once ROOT_PATH . 'controllers/MajorController.php'; // Thêm Controller Ngành học

$studentController = new StudentController();
$majorController = new MajorController();
$majors = $majorController->index(); // Lấy danh sách ngành học

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentController->store($_POST);
    header("Location: index.php");
    exit();
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Thêm Sinh Viên</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Mã SV</label>
            <input type="text" name="MaSV" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Họ Tên</label>
            <input type="text" name="HoTen" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giới Tính</label>
            <select name="GioiTinh" class="form-control">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày Sinh</label>
            <input type="date" name="NgaySinh" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hình</label>
            <input type="file" name="Hinh" class="form-control" id="imageUpload" required>
            <img id="imagePreview" src="#" alt="Xem trước ảnh" class="mt-2" style="display:none; width: 150px;">
        </div>

        <div class="mb-3">
            <label class="form-label">Ngành Học</label>
            <select name="MaNganh" class="form-control" required>
                <option value="">-- Chọn ngành học --</option>
                <?php foreach ($majors as $major) : ?>
                    <option value="<?= $major['MaNganh'] ?>"><?= htmlspecialchars($major['TenNganh']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="index.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php require_once ROOT_PATH . 'views/layout/footer.php'; ?>
<script>
document.getElementById("imageUpload").onchange = function(event) {
    let reader = new FileReader();
    reader.onload = function() {
        let img = document.getElementById("imagePreview");
        img.src = reader.result;
        img.style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
};
</script>

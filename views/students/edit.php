<?php
require_once __DIR__ . '/../../config.php';
require_once ROOT_PATH . 'views/layout/header.php';
require_once ROOT_PATH . 'controllers/StudentController.php';
require_once ROOT_PATH . 'controllers/MajorController.php'; // Thêm Controller Ngành học

$studentController = new StudentController();
$majorController = new MajorController();
$majors = $majorController->index(); // Lấy danh sách ngành học
$student = null;

if (isset($_GET['MaSV'])) {
    $student = $studentController->show($_GET['MaSV']);
}

if (!$student) {
    die("Sinh viên không tồn tại.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentController->update($_POST['MaSV'], $_POST, $_FILES);
    header("Location: index.php");
    exit();
}

?>

<div class="container mt-5">
    <h2 class="mb-4">Chỉnh sửa Sinh Viên</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Mã SV</label>
            <input type="text" name="MaSV" class="form-control" value="<?= htmlspecialchars($student['MaSV']) ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Họ Tên</label>
            <input type="text" name="HoTen" class="form-control" value="<?= htmlspecialchars($student['HoTen']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giới Tính</label>
            <select name="GioiTinh" class="form-control">
                <option value="Nam" <?= $student['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                <option value="Nữ" <?= $student['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày Sinh</label>
            <input type="date" name="NgaySinh" class="form-control" value="<?= htmlspecialchars($student['NgaySinh']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hình</label>
            <input type="file" name="Hinh" class="form-control" id="imageUpload">
            <img id="imagePreview" src="<?= BASE_URL . 'uploads/' . $student['Hinh'] ?>"
                alt="Hình Sinh Viên" class="mt-2" style="width: 150px;">
        </div>

        <div class="mb-3">
            <label class="form-label">Ngành Học</label>
            <select name="MaNganh" class="form-control" required>
                <option value="">-- Chọn ngành học --</option>
                <?php foreach ($majors as $major) : ?>
                    <option value="<?= $major['MaNganh'] ?>" <?= $student['MaNganh'] == $major['MaNganh'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($major['TenNganh']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
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

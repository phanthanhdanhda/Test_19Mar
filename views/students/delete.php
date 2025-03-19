<?php 
require_once __DIR__ . '/../../config.php';
require_once '../../controllers/StudentController.php';

if (isset($_GET['MaSV'])) {
    $studentController = new StudentController();
    $studentController->destroy($_GET['MaSV']);
} else {
    die("Mã sinh viên không hợp lệ.");
}


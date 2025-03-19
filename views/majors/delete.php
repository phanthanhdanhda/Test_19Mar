<?php 
require_once __DIR__ . '/../../config.php';
require_once ROOT_PATH . 'controllers/MajorController.php';

$majorController = new MajorController();

if (isset($_GET['MaNganh'])) {
    $majorController->destroy($_GET['MaNganh']);
}

header("Location: index.php");
exit();

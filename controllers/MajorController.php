<?php
require_once ROOT_PATH . 'models/Major.php';

class MajorController {
    private $majorModel;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->majorModel = new Major($db);
    }

    public function index() {
        return $this->majorModel->getAll();
    }

    public function show($MaNganh) {
        return $this->majorModel->getById($MaNganh);
    }

    public function store($data) {
        if (!isset($data['MaNganh']) || !isset($data['TenNganh'])) {
            return false;
        }
        return $this->majorModel->create($data);
    }

    public function update($data) {
        if (!isset($data['MaNganh']) || !isset($data['TenNganh'])) {
            return false;
        }
        return $this->majorModel->update($data);
    }

    public function destroy($MaNganh) {
        return $this->majorModel->delete($MaNganh);
    }
}

<?php
session_start();
require_once __DIR__ . '/controller/StudentController.php';

$action = $_GET['action'] ?? 'list';
$controller = new StudentController();

switch ($action) {
    case 'list':
        $controller->list();
        break;

    case 'add':
        $controller->add();
        break;

    case 'edit':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $controller->edit($id);
        break;

    case 'delete':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $controller->delete($id);
        break;

    default:
        header('Location: index.php?action=list');
        break;
}

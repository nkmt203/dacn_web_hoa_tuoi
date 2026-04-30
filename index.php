<?php
session_start();
require_once __DIR__ . '/config/config.php';
$router = $_GET['router'] ?? 'customers';
switch ($router) {
    case 'login':
        require_once __DIR__ . '/app/controllers/login/login_ctrl.php';
        $ctrl = new LoginController();
        $ctrl->login();
        break;
    case 'logout':
        require_once __DIR__ . '/app/controllers/login/login_ctrl.php';
        $ctrl = new LoginController();
        $ctrl->logout();
        break;
    case 'customers':
        require_once __DIR__ . '/app/views/customers/index.php';
        break;
    case 'admins':
        require_once __DIR__ . '/app/views/admins/index.php';
        break;
    default:
        echo "<h1>404 ERROR !</h1>";
        break;
}

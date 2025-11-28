<?php
session_start();
require_once __DIR__ . '/config/config.php';
$router = $_GET['router'] ?? 'login';
switch ($router) {
    case 'login':
        require_once __DIR__ . '/app/controllers/login/login_ctrl.php';
        $ctrl = new LoginController();
        $ctrl->login();
        break;
    default:
        echo "<h1>404 ERROR !</h1>";
        break;
}

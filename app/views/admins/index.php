<?php
session_start();
require_once __DIR__ . '/../../../config/config.php';
if (isset($_GET['controller'])) {
    $controllerURL = $_GET['controller'];
} else {
    $controllerURL = 'dashboard';
}

if (isset($_GET['action'])) {
    $actionURL = $_GET['action'];
} else {
    $actionURL = 'index';
}

$controllerPath = '';
switch ($controllerURL) {
    case 'dashboard':
        $controllerPath = "../../controllers/admins/dashboard_ctrl.php";
        break;
    case 'product':
        $controllerPath = "../../controllers/admins/product_ctrl.php";
        break;
    case 'category':
        $controllerPath = "../../controllers/admins/category_ctrl.php";
        break;
    case 'accountAdmin':
        $controllerPath = "../../controllers/admins/account_admin_ctrl.php";
        break;
    case 'accountCustomer':
        $controllerPath = "../../controllers/admins/account_customer_ctrl.php";
        break;
    case 'order':
        $controllerPath = "../../controllers/admins/order_ctrl.php";
        break;
    default:
        break;
}
if (!file_exists($controllerPath)) {
    die("<h2><i> Không tìm thấy file controller:</i> $controllerPath </h2>");
}
require_once $controllerPath;

$className = ucfirst($controllerURL) . 'Controller';
if (!class_exists($className)) {
    die("<h2><i> Không tìm thấy class:</i> $className </h2>");
}

$controller = new $className();
if (!method_exists($className, $actionURL)) {
    die("<h2><i> Không tìm thấy action:</i> $actionURL trong controller: $className</h2>");
}
$controller->$actionURL();

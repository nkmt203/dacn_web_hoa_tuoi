<?php
require_once __DIR__ . '/../../models/account_admin_model.php';
require_once __DIR__ . '/../../models/account_customer_model.php';
require_once __DIR__ . '/../../../helpers/message_helper.php';
class LoginController
{
    private $customerModel;
    private $adminModel;
    public function __construct()
    {
        $this->customerModel = new AccountCustomerModel();
        $this->adminModel = new AccountAdminModel();
    }

    public function login()
    {
        $role = $_POST['role'] ?? '';
        if (isset($_POST['btnLoginAdmin']) || isset($_POST['btnLoginCustomer'])) {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            //role Login Admin
            if ($role === 'admin') {
                $adminLogin = $this->adminModel->getByAdminUsername($username);
                if ($adminLogin && password_verify($password, $adminLogin['password'])) {
                    $_SESSION['admin'] = $adminLogin;
                    MessageHelper::success("Đăng nhập Admin thành công !!!");
                    header("Location: /app/views/admins/index.php?controller=dashboard");
                    exit;
                } else {
                    MessageHelper::error("Sai tài khoản hoặc mặt khẩu !!!");
                }
            }

            //role Login Customer
            if ($role === 'customer') {
                $customerLogin = $this->customerModel->getByCustomerUsername($username);
                if ($customerLogin && password_verify($password, $customerLogin['password'])) {
                    $_SESSION['customer'] = $customerLogin;
                    //MessageHelper::success("Đăng nhập thành công !!!");
                    header("Location: /app/views/customers/index.php");
                    exit;
                } else {
                    MessageHelper::error("Sai tài khoản hoặc mặt khẩu !!!");
                }
            }
        }
        require_once __DIR__ . '/../../views/login.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header("Location: index.php?router=login");
        exit;
    }
}

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
                    //MessageHelper::success("Đăng nhập Admin thành công !!!");
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
                    header("Location: index.php?router=customers&controller=index&action=index");
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
        header("Location: index.php?router=customers&controller=index&action=index");
        exit;
    }

    public function register()
    {
        if (isset($_POST['btnRegister'])) {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $full_name = trim($_POST['full_name']);
            $phone = trim($_POST['phone']);
            $address = trim($_POST['address']);

            if ($password !== $confirm_password) {
                MessageHelper::error("Mật khẩu xác nhận không khớp!");
            } elseif ($this->customerModel->checkExists($username, $email)) {
                MessageHelper::error("Tên đăng nhập hoặc email đã tồn tại!");
            } else {
                $data = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'full_name' => $full_name,
                    'phone' => $phone,
                    'address' => $address
                ];
                if ($this->customerModel->createAccountCustomer($data)) {
                    MessageHelper::success("Đăng ký tài khoản thành công! Vui lòng đăng nhập.");
                    header("Location: index.php?router=login");
                    exit;
                } else {
                    MessageHelper::error("Có lỗi xảy ra trong quá trình đăng ký!");
                }
            }
        }
        require_once __DIR__ . '/../../views/register.php';
    }
}

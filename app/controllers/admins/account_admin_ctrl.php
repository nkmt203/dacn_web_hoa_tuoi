<?php
require_once __DIR__ . '/../../models/account_admin_model.php';
class AccountAdminController
{
    private $model;
    public function __construct()
    {
        $this->model = new AccountAdminModel();
    }

    public function listAccountAdmin()
    {
        $viewFile = "../../views/admins/accounts/admins/list_account.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function addAccountAdmin()
    {
        if (isset($_POST['btnAddAccountAdmin']) && $_POST['btnAddAccountAdmin']) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $full_name = $_POST['full_name'];
            $phone = $_POST['phone'];
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            if ($this->model->checkUsername($username)) {
                $_SESSION['error'] = "Tên tài khoản <b>$username</b> đã tồn tại!!";
                header("Location: index.php?controller=accountAdmin&action=addAccountAdmin");
                exit;
            }

            if ($this->model->checkEmail($email)) {
                $_SESSION['error'] = "Email <b>$email</b> này đã tồn tại!!";
                header("Location: index.php?controller=accountAdmin&action=addAccountAdmin");
                exit;
            }
            $addAccountAdmin = $this->model->addAccountAdmin($username, $email, $hashedPass, $full_name, $phone);
            if ($addAccountAdmin) {
                $_SESSION['success'] = "Tạo tài khoản thành công!";
                header("Location: index.php?controller=accountAdmin&action=listAccountAdmin");
                exit;
            } else {
                echo "Thêm thất bại";
            }
        }
        $viewFile = "../../views/admins/accounts/admins/add_account_admin.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function deleteAccountAdmin()
    {
        $admin_id = $_GET['admin_id'];
        if (isset($admin_id)) {
            $deleteAccountAdmin = $this->model->deleteAccountAdmin($admin_id);
            if ($deleteAccountAdmin) {
                $_SESSION['success'] = "Xóa tài khoản thành công!";
                header("Location: index.php?controller=accountAdmin&action=listAccountAdmin");
                exit;
            } else {
                echo "Xóa thật bại";
            }
        } else {
            echo "Không tìm thấy id cần xóa";
        }
    }
}

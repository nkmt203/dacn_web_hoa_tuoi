<?php
require_once __DIR__ . '/../../models/account_customer_model.php';
require_once __DIR__ . '/../../../helpers/message_helper.php';
class AccountCustomerController
{
    private $model;
    public function __construct()
    {
        $this->model = new AccountCustomerModel();
    }

    public function listAccountCustomer()
    {
        $viewFile = "../../views/admins/accounts/customers/list_account.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function deleteAccountCustomer()
    {
        $customer_id = $_GET['customer_id'];
        if (isset($customer_id)) {
            $deleteAccountAdmin = $this->model->deleteAccountCustomer($customer_id);
            if ($deleteAccountAdmin) {
                MessageHelper::success("Xóa thành công tài khoản !!!");
                header("Location: index.php?controller=accountCustomer&action=listAccountCustomer");
                exit;
            } else {
                MessageHelper::error("Xóa thất bại");
            }
        } else {
            MessageHelper::error("Không tìm thấy id cần xóa");
        }
        $viewFile = "../../views/admins/accounts/customers/list_account.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }
}

<?php
include_once __DIR__ . '/../../models/order_model.php';
include_once __DIR__ . '/../../../helpers/message_helper.php';
class OrderController
{
    private $model;
    public function __construct()
    {
        $this->model = new OrderModel();
    }

    public function listOrder()
    {
        $listOrder = $this->model->getAllOrder();
        $viewFile = "../../views/admins/orders/list_order.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function listOrderDetail()
    {
        $order_id = $_GET['order_id'];
        if (isset($order_id)) {
            $order = $this->model->getByIdOrder($order_id);

            if ($order) {
                $listOrderDetail = $this->model->getByIdOrderDetail($order_id);
            } else {
                MessageHelper::error("Không có đơn hàng này");
                header("Location: index.php?controller=order&action=listOrder");
            }
        } else {
            MessageHelper::error("Không tìm thấy order_id");
            header("Location: index.php?controller=order&action=listOrder");
        }
        $viewFile = "../../views/admins/orders/list_order_detail.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    
}

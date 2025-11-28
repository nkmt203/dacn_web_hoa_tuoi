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
        $status = $_GET['status'] ?? null;

        if ($status) {
            $listOrder = $this->model->getByOrderStatus($status);
        } else {
            $listOrder = $this->model->getAllOrder();
        }
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

    private function handleUpdateOrderStatus($order_id, $currentOrderStatus, $newStatus, $message)
    {
        $order_id = $_GET['order_id'];
        if (!$order_id) {
            MessageHelper::error("Không tìm thấy order_id !!! ");
            header("Location: index.php?controller=order&action=listOrder");
            exit();
        }

        $order = $this->model->getByIdOrder($order_id);
        if (!$order) {
            MessageHelper::error("Đơn hàng này không tồn tại");
            header("Location: index.php?controller=order&action=listOrder");
            exit();
        }

        if ($order['order_status'] === $currentOrderStatus) {
            $updateStatusOrder = $this->model->updateOrderStatus($order_id, $newStatus);
            if ($updateStatusOrder) {
                MessageHelper::success($message);
            } else {
                MessageHelper::error("Cập nhật trạng thái thất bại !!!");
            }
        } else {
            MessageHelper::error("Lỗi trạng thái đơn hàng !!. Trạng thái hiện tại {order_id[order_status]}");
        }

        header("Location: index.php?controller=order&action=listOrderDetail&order_id=$order_id");
        exit();
    }

    public function confirm()
    {
        $order_id = $_GET['order_id'] ?? null;
        $this->handleUpdateOrderStatus($order_id, 'pending', 'confirmed', "ĐÃ XÁC NHẬN đơn hàng thành công !!");
    }

    public function shipping()
    {
        $order_id = $_GET['order_id'] ?? null;
        $this->handleUpdateOrderStatus($order_id, 'confirmed', 'shipping', "Đơn hàng đã được chuyển sang trạng thái ĐANG GIAO !!");
    }

    public function completed()
    {
        $order_id = $_GET['order_id'] ?? null;
        $this->handleUpdateOrderStatus($order_id, 'shipping', 'completed', "Đơn hàng đã HOÀN THÀNH !!");
    }

    public function cancelled()
    {
        $order_id = $_GET['order_id'] ?? null;
        $order = $this->model->getByIdOrder($order_id);

        if (!$order || !$order_id) {
            MessageHelper::error("Đơn hàng không tồn tại hoặc không tìm thấy order_id");
            header("Location: index.php?controller=order&action=listOrder");
            exit();
        }

        if (in_array($order['order_status'], ['pending', 'confirmed', 'shipping'])) {
            $updateStatusOrder = $this->model->updateOrderStatus($order_id, 'cancelled');
            if ($updateStatusOrder) {
                MessageHelper::success("Đơn hàng đã được hủy thành công !!!");
            } else {
                MessageHelper::error("HỦY đơn hàng thất bại");
            }
        } else {
            MessageHelper::error("Đơn hàng không thể hủy ở trạng thái hiện tại {$order['order_status']}");
        }
        header("Location: index.php?controller=order&action=listOrderDetail&order_id=$order_id");
        exit();
    }

    public function deleted()
    {
        if (isset($_GET['order_id'])) {
            $order_id = $_GET['order_id'];
            $deleteOrder = $this->model->deleteOrder($order_id);

            if ($deleteOrder) {
                MessageHelper::success("Xóa đơn hàng này thành công");
                header("Location: index.php?controller=order&action=listOrder");
                exit();
            } else {
                MessageHelper::error("Xóa đơn hàng thất bại");
            }
        }
        MessageHelper::error("Không tìm thấy order_id");
    }
}

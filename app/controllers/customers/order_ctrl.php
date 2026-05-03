<?php
require_once __DIR__ . '/../../models/order_model.php';
require_once __DIR__ . '/../../models/cart_model.php';

class OrderController
{
    private $orderModel;
    private $cartModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->cartModel = new CartModel();
    }

    public function index()
    {
        if (!isset($_SESSION['customer'])) {
            header('Location: index.php?router=login');
            exit();
        }

        $customer_id = $_SESSION['customer']['customer_id'];
        $listCart = $this->cartModel->getCartByCustomer($customer_id);

        if (empty($listCart)) {
            $_SESSION['error'] = "Giỏ hàng của bạn đang trống!";
            header('Location: index.php?router=customers&controller=cart&action=listCart');
            exit();
        }

        // Pre-fill receiver info from customer profile if available
        $customer = $_SESSION['customer'];

        require_once __DIR__ . '/../../views/customers/orders/order.php';
    }

    public function placeOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['customer'])) {
                header('Location: index.php?router=login');
                exit();
            }

            $customer_id = $_SESSION['customer']['customer_id'];
            $receiver_name = $_POST['receiver_name'] ?? '';
            $receiver_phone = $_POST['receiver_phone'] ?? '';
            $delivery_address = $_POST['delivery_address'] ?? '';
            $note = $_POST['note'] ?? '';
            $payment_method = $_POST['payment_method'] ?? 'cod';

            if (empty($receiver_name) || empty($receiver_phone) || empty($delivery_address)) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin giao hàng!";
                header('Location: index.php?router=customers&controller=order&action=index');
                exit();
            }

            $listCart = $this->cartModel->getCartByCustomer($customer_id);
            if (empty($listCart)) {
                $_SESSION['error'] = "Giỏ hàng trống!";
                header('Location: index.php?router=customers&controller=cart&action=listCart');
                exit();
            }

            $total_amount = 0;
            foreach ($listCart as $item) {
                $price = $item['discounted_price'] ?? $item['price'];
                $total_amount += $price * $item['quantity'];
            }

            $order_id = $this->orderModel->createOrder(
                $customer_id,
                $total_amount,
                $receiver_name,
                $receiver_phone,
                $delivery_address,
                $note,
                $payment_method
            );

            if ($order_id) {
                foreach ($listCart as $item) {
                    $price = $item['discounted_price'] ?? $item['price'];
                    $subtotal = $price * $item['quantity'];
                    $this->orderModel->createOrderDetail($order_id, $item['product_id'], $item['quantity'], $price, $subtotal);
                    
                    // Optional: Update stock quantity here
                }

                $this->cartModel->clearCart($customer_id);
                $_SESSION['success'] = "Đặt hàng thành công!";
                header('Location: index.php?router=customers&controller=order&action=success&id=' . $order_id);
                exit();
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi đặt hàng!";
                header('Location: index.php?router=customers&controller=order&action=index');
                exit();
            }
        }
    }

    public function success()
    {
        $order_id = $_GET['id'] ?? 0;
        $order = $this->orderModel->getByIdOrder($order_id);
        if (!$order || $order['customer_id'] != $_SESSION['customer']['customer_id']) {
            header('Location: index.php?router=customers');
            exit();
        }
        require_once __DIR__ . '/../../views/customers/orders/success.php';
    }

    public function listOrders()
    {
        if (!isset($_SESSION['customer'])) {
            header('Location: index.php?router=login');
            exit();
        }

        $customer_id = $_SESSION['customer']['customer_id'];
        $orders = $this->orderModel->getOrdersByCustomer($customer_id);

        require_once __DIR__ . '/../../views/customers/orders/list_orders.php';
    }

    public function viewDetail()
    {
        if (!isset($_SESSION['customer'])) {
            header('Location: index.php?router=login');
            exit();
        }

        $order_id = $_GET['id'] ?? 0;
        $order = $this->orderModel->getByIdOrder($order_id);

        if (!$order || $order['customer_id'] != $_SESSION['customer']['customer_id']) {
            header('Location: index.php?router=customers&controller=order&action=listOrders');
            exit();
        }

        $orderDetails = $this->orderModel->getByIdOrderDetail($order_id);

        require_once __DIR__ . '/../../views/customers/orders/order_detail.php';
    }
}

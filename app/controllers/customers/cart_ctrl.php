<?php
include_once __DIR__ . '/../../models/cart_model.php';
include_once __DIR__ . '/../../../helpers/message_helper.php';

class CartController
{
    private $model;

    public function __construct()
    {
        $this->model = new CartModel();
    }

    public function listCart()
    {
        if (!isset($_SESSION['customer'])) {
            MessageHelper::error("Vui lòng đăng nhập để xem giỏ hàng");
            header("Location: index.php?router=login");
            exit();
        }

        $customer_id = $_SESSION['customer']['customer_id'];
        $listCart = $this->model->getCartByCustomer($customer_id);

        if (empty($listCart)) {
            require_once __DIR__ . '/../../views/customers/carts/empty_cart.php';
        } else {
            require_once __DIR__ . '/../../views/customers/carts/list_cart.php';
        }
    }

    public function addCart()
    {
        if (!isset($_SESSION['customer'])) {
            MessageHelper::error("Vui lòng đăng nhập để thêm vào giỏ hàng");
            header("Location: index.php?router=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?router=customers&controller=cart&action=listCart");
            exit();
        }

        $customer_id = $_SESSION['customer']['customer_id'];
        $product_id  = $_POST['product_id'] ?? 0;
        $quantity    = $_POST['quantity'] ?? 1;

        $product = $this->model->getProductById($product_id);

        if (!$product) {
            MessageHelper::error("Sản phẩm không tồn tại");
            header("Location: index.php?router=customers");
            exit();
        }

        if ($product['stock_quantity'] < $quantity) {
            MessageHelper::error("Số lượng vượt quá tồn kho");
            header("Location: index.php?router=customers&controller=detail&action=index&id=" . $product_id);
            exit();
        }

        $cartItem = $this->model->findCartItem($customer_id, $product_id);

        if ($cartItem) {
            $newQuantity = $cartItem['quantity'] + $quantity;

            if ($newQuantity > $product['stock_quantity']) {
                MessageHelper::error("Tổng số lượng trong giỏ vượt quá tồn kho");
                header("Location: index.php?router=customers&controller=detail&action=index&id=" . $product_id);
                exit();
            }

            $this->model->updateCartQuantity($cartItem['cart_id'], $newQuantity);
        } else {
            $this->model->addCart($customer_id, $product_id, $quantity);
        }

        MessageHelper::success("Đã thêm sản phẩm vào giỏ hàng");
        header("Location: index.php?router=customers&controller=cart&action=listCart");
        exit();
    }

    public function deleteCart()
    {
        if (!isset($_SESSION['customer'])) {
            header("Location: index.php?router=login");
            exit();
        }

        $cart_id = $_GET['cart_id'] ?? 0;
        $customer_id = $_SESSION['customer']['customer_id'];

        $this->model->deleteCart($cart_id, $customer_id);

        MessageHelper::success("Đã xóa sản phẩm khỏi giỏ hàng");
        header("Location: index.php?router=customers&controller=cart&action=listCart");
        exit();
    }

    public function updateCart()
    {
        if (!isset($_SESSION['customer'])) {
            header("Location: index.php?router=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cart_id = $_POST['cart_id'] ?? 0;
            $quantity = (int)($_POST['quantity'] ?? 1);
            $product_id = $_POST['product_id'] ?? 0;
            
            $product = $this->model->getProductById($product_id);
            if (!$product) {
                MessageHelper::error("Sản phẩm không tồn tại");
            } elseif ($quantity > $product['stock_quantity']) {
                MessageHelper::error("Số lượng vượt quá tồn kho (còn {$product['stock_quantity']} sp)");
            } elseif ($quantity < 1) {
                MessageHelper::error("Số lượng không hợp lệ");
            } else {
                $this->model->updateCartQuantity($cart_id, $quantity);
                MessageHelper::success("Đã cập nhật số lượng");
            }
        }
        
        header("Location: index.php?router=customers&controller=cart&action=listCart");
        exit();
    }
}

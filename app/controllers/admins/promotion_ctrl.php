<?php
include_once __DIR__ . '/../../models/promotion_model.php';
include_once __DIR__ . '/../../models/product_model.php';
include_once __DIR__ . '/../../../helpers/message_helper.php';
class PromotionController
{
    private $model;
    private $modelProduct;
    public function __construct()
    {
        $this->model = new PromotionModel();
        $this->modelProduct = new ProductModel();
    }

    public function listPromotion()
    {
        $page = $_GET['page'] ?? 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $listPromotion = $this->model->getPromotionPagination($limit, $offset);
        $totalPromotions = $this->model->countPromotion();
        $totalPages = ceil($totalPromotions / $limit);

        $viewFile = "../../views/admins/promotions/list_promotion.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function addPromotion()
    {
        if (isset($_POST['btnAddPromotion']) && $_POST['btnAddPromotion']) {
            $promotion_code = trim($_POST['promotion_code']);
            $promotion_name = $_POST['promotion_name'];
            $description = $_POST['description'];
            $discount_value = $_POST['discount_value'];
            $discount_type = $_POST['discount_type'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $status = $_POST['status'];

            if ($this->model->isPromotionCode($promotion_code)) {
                MessageHelper::error("Mã khuyến mãi hiện tại đã trùng. Vui lòng nhập lại !!");
                header("Location: index.php?controller=promotion&action=addPromotion");
                exit();
            }
            if (strtotime($start_date) > strtotime($end_date)) {
                MessageHelper::error("Ngày bắt đầu không lớn hơn ngày kết thúc. Vui lòng thử lại");
                header("Location: index.php?controller=promotion&action=addPromotion");
                exit();
            }

            if ($discount_value <= 0) {
                MessageHelper::error("Giá trị giảm giá không thể nhỏ hơn hoặc = 0");
                header("Location: index.php?controller=promotion&action=addPromotion");
                exit();
            }
            $addPromotion = $this->model->addPromotion(
                $promotion_code,
                $promotion_name,
                $description,
                $discount_value,
                $discount_type,
                $start_date,
                $end_date,
                $status
            );
            if ($addPromotion) {
                MessageHelper::success("Thêm khuyến mãi mới thành công !!!");
                header("Location: index.php?controller=promotion&action=listPromotion");
                exit();
            } else {
                MessageHelper::error("THêm Khuyến mãi mới thất bại !!!");
                header("Location: index.php?controller=promotion&action=listPromotion");
                exit();
            }
        }
        $viewFile = "../../views/admins/promotions/add_promotion.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function deletePromotion()
    {
        if (isset($_GET['promotion_id'])) {
            $promotion_id = $_GET['promotion_id'];
            $deletePromotion = $this->model->deletePromotion($promotion_id);
            if ($deletePromotion) {
                MessageHelper::success("Xóa thành công khuyến mãi");
                header("Location: index.php?controller=promotion&action=listPromotion");
                exit();
            } else {
                MessageHelper::error("Xóa Thất bại khuyến mãi");
                header("Location: index.php?controller=promotion&action=listPromotion");
            }
        } else {
            MessageHelper::error("KHông tồn tại id cần xóa");
            header("Location: index.php?controller=promotion&action=listPromotion");
        }
    }

    public function updatePromotion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!isset($_GET['promotion_id'])) {
                MessageHelper::error("Không có ID khuyến mãi cần cập nhật!");
                header("Location: index.php?controller=promotion&action=listPromotion");
                exit();
            }
            $promotion_id = $_GET['promotion_id'];
            $promotion = $this->model->getByIdPromotion($promotion_id);
            if (!$promotion) {
                MessageHelper::error("Khuyến mãi không tồn tại hoặc đã bị xóa!");
                header("Location: index.php?controller=promotion&action=listPromotion");
                exit();
            }
        }

        if (isset($_POST['btnUpdatePromotion']) && $_POST['btnUpdatePromotion']) {
            $promotion_id = $_GET['promotion_id'];
            $promotion_name = $_POST['promotion_name'];
            $description = $_POST['description'];
            $discount_value = $_POST['discount_value'];
            $discount_type = $_POST['discount_type'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $status = $_POST['status'];

            if (strtotime($start_date) > strtotime($end_date)) {
                MessageHelper::error("Ngày bắt đầu không lớn hơn ngày kết thúc. Vui lòng thử lại");
                header("Location: index.php?controller=promotion&action=updatePromotion&promotion_id=$promotion_id");

                exit();
            }

            if ($discount_value <= 0) {
                MessageHelper::error("Giá trị giảm giá không thể nhỏ hơn hoặc = 0");
                header("Location: index.php?controller=promotion&action=updatePromotion&promotion_id=$promotion_id");
                exit();
            }
            $updatePromotion = $this->model->updatePromotion(
                $promotion_id,
                $promotion_name,
                $description,
                $discount_value,
                $discount_type,
                $start_date,
                $end_date,
                $status
            );
            if ($updatePromotion) {
                MessageHelper::success("Cập nhật khuyến mãi thành công !!!");
                header("Location: index.php?controller=promotion&action=listPromotion");
                exit();
            } else {
                MessageHelper::error("Cập nhật Khuyến mãi thất bại !!!");
                header("Location: index.php?controller=promotion&action=listPromotion");
                exit();
            }
        }
        $viewFile = "../../views/admins/promotions/update_promotion.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function applyProductPromotion()
    {
        if (isset($_POST['btnApplyProductPromotion']) && $_POST['btnApplyProductPromotion']) {
            $product_id = $_POST['product_id'];
            $promotion_id = $_POST['promotion_id'];

            $product = $this->modelProduct->getByIdProduct($product_id);
            $product_name = $product['product_name'];

            $isCheckActiveProductPromotion = $this->model->isCheckActiveProductPromotion($product_id);
            if ($isCheckActiveProductPromotion) {
                MessageHelper::error("Sản phẩm <b>$product_name</b> đang có khuyến mãi khác không thể áp dụng");
                header("Location: index.php?controller=promotion&action=applyProductPromotion");
                exit;
            }

            $applyProductPromotion = $this->model->applyProductPromotion($product_id, $promotion_id);
            if ($applyProductPromotion) {
                MessageHelper::success("Áp dụng khuyến mãi cho sản phẩm <b>$product_name</b> thành công !!");
                header("Location: index.php?controller=promotion&action=listApplyProductPromotion");
                exit;
            } else {
                MessageHelper::error("Áp dụng khuyến mãi cho sản phẩm <b>$product_name</b> thất bại vui lòng kiểm tra lại");
                header("Location: index.php?controller=promotion&action=applyProductPromotion");
                exit;
            }
        }
        $viewFile = "../../views/admins/promotions/apply_product_promotion.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function listApplyProductPromotion()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $listApplyProductPromotion = $this->model->getPaginationAllApplyProductPromotion($limit, $offset);
        $totalPromotions = $this->model->countApplyProductPromotion();
        $totalPages = ceil($totalPromotions / $limit);

        $viewFile = "../../views/admins/promotions/list_apply_product_promotion.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function removeProductPromotion()
    {

        if (isset($_GET['product_promotion_id'])) {
            $product_promotion_id = $_GET['product_promotion_id'];
            $removeProductPromotion = $this->model->removeProductPromotion($product_promotion_id);

            if ($removeProductPromotion) {
                MessageHelper::success("Gở bỏ khuyến mãi cho sản phẩm thành công !!");
                header("Location: index.php?controller=promotion&action=listAllProductPromotion");
                exit;
            } else {
                MessageHelper::error("Gở bỏ khuyến mãi thất bại. Vui lòng kiểm tra lại !!");
                header("Location: index.php?controller=promotion&action=listAllProductPromotion");
                exit;
            }
        } else {
            MessageHelper::error("Không tìm thấy product_promotion_id ");
            header("Location: index.php?controller=promotion&action=listAllProductPromotion");
            exit;
        }
    }


    public function listExpiredProductPromotion()
    {
        $limit = 5;
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * $limit;

        $promotionModel = new PromotionModel();

        $total = $promotionModel->countExpiredProductPromotion();
        $totalPages = ceil($total / $limit);

        $listExpired = $promotionModel->getPaginationExpiredProductPromotion($limit, $offset);
        $viewFile = "../../views/admins/promotions/list_expired_product_promotion.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function listInactiveProductPromotion()
    {
        $limit = 5;
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * $limit;

        $promotionModel = new PromotionModel();

        $total = $promotionModel->countInactiveProductPromotion();
        $totalPages = ceil($total / $limit);

        $listInactive = $promotionModel->getPaginationInactiveProductPromotion($limit, $offset);
        $viewFile = "../../views/admins/promotions/list_inactive_product_promotion.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function listAllProductPromotion()
    {
        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit;

        $promotionModel = new PromotionModel();

        $total = $promotionModel->countAllProductPromotion();
        $totalPages = ceil($total / $limit);

        $listAll = $promotionModel->getPaginationAllProductPromotion($limit, $offset);

        $viewFile = "../../views/admins/promotions/list_all_product_promotion.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function updateProductPromotion()
    {
        if (!isset($_GET['product_promotion_id']) || empty($_GET['product_promotion_id'])) {
            MessageHelper::error("Không tìm thấy sản phẩm cần cập nhật!");
            header("Location: index.php?controller=promotion&action=listAllProductPromotion");
            exit();
        }

        $product_promotion_id = (int)$_GET['product_promotion_id'];

        $apply = $this->model->getByIdProductPromotion($product_promotion_id);
        if (!$apply) {
            MessageHelper::error("Sản phẩm không tồn tại hoặc đã bị xóa!");
            header("Location: index.php?controller=promotion&action=listAllProductPromotion");
            exit();
        }

        if (isset($_POST['btnUpdateProductPromotion'])) {

            $post_id = $_POST['product_promotion_id'] ?? null;
            $promotion_id = $_POST['promotion_id'] ?? null;

            if (!$post_id || !$promotion_id) {
                MessageHelper::error("Vui lòng chọn mã khuyến mãi mới!");
                header("Location: index.php?controller=promotion&action=updateProductPromotion&product_promotion_id=" . $product_promotion_id);
                exit();
            }

            // Không cho update trùng mã
            if ($promotion_id == $apply['promotion_id']) {
                MessageHelper::error("Bạn chưa chọn mã khuyến mãi mới!");
                header("Location: index.php?controller=promotion&action=updateProductPromotion&product_promotion_id=" . $product_promotion_id);
                exit();
            }

            $update = $this->model->updateProductPromotion($post_id, $promotion_id);
            if ($update) {
                MessageHelper::success("Cập nhật khuyến mãi thành công!");
            } else {
                MessageHelper::error("Cập nhật thất bại!");
            }

            header("Location: index.php?controller=promotion&action=listAllProductPromotion");
            exit();
        }

        $listPromotionActive = $this->model->getPromotionActive();
        $viewFile = "../../views/admins/promotions/update_product_promotion.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }
}

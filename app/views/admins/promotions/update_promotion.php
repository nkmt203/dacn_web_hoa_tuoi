<?php
//code test data
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/promotion_model.php';
$promotionModel = new PromotionModel();
$listEnumDiscountType = $promotionModel->getValueDiscountType();
$listEnumStatus = $promotionModel->getValueStatus();

$promotion_id = $_GET['promotion_id'];  
$onePromotion = $promotionModel->getByIdPromotion($promotion_id);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm khuyến mãi</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4 text-center fw-bold text-primary">
            <i class="fa-solid fa-gift me-2"></i> Cập nhật khuyến mãi
        </h2>

        <?php
        require_once __DIR__ . '/../../../../helpers/message_helper.php';
        MessageHelper::logMessage();
        ?>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <form action="index.php?controller=promotion&action=updatePromotion&promotion_id=<?= $onePromotion['promotion_id'] ?>" method="POST">

                            <div class="mb-3" style="font-size: 30px; text-align: center;">
                                <i class="fa-solid fa-barcode me-2"></i>
                                <span><?= $onePromotion['promotion_code'] ?></span>
                            </div>

                            <div class="mb-3">
                                <label for="promotion_name" class="form-label fw-bold">
                                    <i class="fa-solid fa-tag me-2"></i> Tên khuyến mãi
                                </label>
                                <input type="text" class="form-control" id="promotion_name" name="promotion_name" value="<?= $onePromotion['promotion_name'] ?>" placeholder="Nhập tên khuyến mãi" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fa-solid fa-align-left me-2"></i> Mô tả
                                </label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả chi tiết"><?= $onePromotion['description'] ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="discount_type" class="form-label fw-bold">
                                    <i class="fa-solid fa-list me-2"></i> Loại khuyến mãi
                                </label>
                                <select class="form-select" id="discount_type" name="discount_type" required>
                                    <option value="">-- Chọn loại --</option>
                                    <?php foreach ($listEnumDiscountType as $type): ?>
                                        <option value="<?= $type ?>" <?= ($type == $onePromotion['discount_type'] ? 'selected' : '') ?>>
                                            <?php
                                            switch ($type) {
                                                case 'percentage':
                                                    echo 'Phần trăm (%)';
                                                    break;
                                                case 'fixed_amount':
                                                    echo 'Giá tiền cố định';
                                                    break;
                                                default:
                                                    echo 'Lỗi';
                                                    break;
                                            }
                                            ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="discount_value" class="form-label fw-bold">
                                    <i class="fa-solid fa-percent me-2"></i> Giá trị khuyến mãi
                                </label>
                                <input type="number" class="form-control" id="discount_value" name="discount_value" value="<?= $onePromotion['discount_value'] ?>" placeholder="Nhập giá trị" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label fw-bold">
                                        <i class="fa-solid fa-calendar-plus me-2"></i> Ngày bắt đầu
                                    </label>
                                    <input type="date" class="form-control" id="start_date" value="<?= $onePromotion['start_date'] ?>" name="start_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label fw-bold">
                                        <i class="fa-solid fa-calendar-minus me-2"></i> Ngày kết thúc
                                    </label>
                                    <input type="date" class="form-control" id="end_date" value="<?= $onePromotion['end_date'] ?>" name="end_date" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold">
                                    <i class="fa-solid fa-toggle-on me-2"></i> Trạng thái
                                </label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="">-- Chọn trạng thái --</option>
                                    <?php foreach ($listEnumStatus as $status): ?>
                                        <option value="<?= $status ?>" <?= ($status == $onePromotion['status'] ? 'selected' : '') ?>>
                                            <?php
                                            switch ($status) {
                                                case 'active':
                                                    echo 'Đang hoạt động';
                                                    break;
                                                case 'inactive':
                                                    echo 'Tạm ngưng';
                                                    break;
                                                case 'expired':
                                                    echo 'Hết hạn';
                                                    break;
                                                default:
                                                    echo 'Lỗi';
                                                    break;
                                            }
                                            ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="index.php?controller=promotion&action=listPromotion" class="btn btn-secondary">
                                    <i class="fa-solid fa-arrow-left me-2"></i> Quay lại
                                </a>
                                <input type="submit" name="btnUpdatePromotion" class="btn btn-primary" value="💾 Lưu khuyến mãi">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
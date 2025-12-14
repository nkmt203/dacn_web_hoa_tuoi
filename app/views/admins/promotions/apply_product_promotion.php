<?php
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/promotion_model.php';
require_once __DIR__ . '/../../../models/product_model.php';

$productModel = new ProductModel();
$promotionModel = new PromotionModel();

$listProduct = $productModel->getAllProduct();
$listPromotionActive = $promotionModel->getPromotionActive();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Apply Product Promotion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../../../assets/js/load_img_select.js"></script>
    <style>
        .promotion-card {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .promotion-card:hover {
            transform: scale(1.02);
        }

        .selected {
            border: 2px solid #0d6efd !important;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-5">
        <h2 class="mb-4 text-center">Áp dụng khuyến mãi cho sản phẩm</h2>
        <?php
        require_once __DIR__ . '/../../../../helpers/message_helper.php';
        MessageHelper::logMessage();
        ?>
        <form method="post" action="index.php?controller=promotion&action=applyProductPromotion" class="card p-4 shadow-sm mb-5">
            <div class="mb-4">
                <label for="productSelect" class="form-label">Chọn sản phẩm</label>
                <select class="form-select" id="productSelect" name="product_id" required>
                    <option value="" disabled selected>-- Chọn sản phẩm --</option>
                    <?php foreach ($listProduct as $p): ?>
                        <option value="<?= $p['product_id'] ?>"
                            load-img-select="../../../../uploads/<?= $p['image_url'] ?>">
                            <?= $p['product_name'] ?> (<?= number_format($p['price'], 0, ',', '.') ?>đ)
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="mt-3 text-center">
                    <img id="preview" src="" alt=""
                        style="max-width: 240px; display: none; border-radius: 8px;">
                </div>
                <div id="promotionCodeBox" class="alert alert-info mt-3" style="display:none;"></div>
            </div>

            <div class="mb-4">
                <label class="form-label">Chọn khuyến mãi</label>
                <div class="row">
                    <?php foreach ($listPromotionActive as $pr): ?>
                        <div class="col-md-3 mb-3">
                            <div class="card h-100 promotion-card" onclick="selectPromotion(<?= $pr['promotion_id'] ?>, this)">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $pr['promotion_name'] ?></h5>
                                    <p class="card-text">
                                        <strong>Mã:</strong> <?= $pr['promotion_code'] ?><br>
                                        <small><?= $pr['description'] ?></small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <input type="hidden" name="promotion_id" id="selectedPromotion" required>
            </div>

            <input type="submit" name="btnApplyProductPromotion" class="btn btn-primary" value="Áp dụng khuyến mãi">
        </form>
    </div>

    <script>
        function selectPromotion(id, el) {
            document.getElementById('selectedPromotion').value = id;
            document.querySelectorAll('.promotion-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
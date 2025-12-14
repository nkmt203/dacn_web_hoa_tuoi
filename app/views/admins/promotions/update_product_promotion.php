<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật khuyến mãi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">Cập nhật khuyến mãi</h5>
                    </div>
                    <?php
                    require_once __DIR__ . '/../../../../helpers/message_helper.php';
                    MessageHelper::logMessage();
                    ?>

                    <div class="card-body">

                        <div class="d-flex align-items-center mb-3">
                            <img src="../../../../uploads/<?= $apply['image_url'] ?>"
                                class="rounded me-3" width="130px" style="object-fit: cover;">
                            <div>
                                <h6 class="mb-1"><?= $apply['product_name'] ?></h6>
                                <small class="text-muted">Mã SP: <?= $apply['product_id'] ?></small>
                            </div>
                        </div>

                        <div class="alert alert-info py-2">
                            <strong>Khuyến mãi hiện tại:</strong><br>
                            <?= $apply['promotion_name'] ?> (<?= $apply['promotion_code'] ?>) –
                            <?php if ($apply['discount_type'] == 'percentage'): ?>
                                Giảm <?= $apply['discount_value'] ?>%
                            <?php else: ?>
                                Giảm <?= number_format($apply['discount_value']) ?>đ
                            <?php endif; ?>
                        </div>

                        <form method="post" action="index.php?controller=promotion&action=updateProductPromotion&product_promotion_id=<?= $apply['product_promotion_id'] ?>">

                            <input type="hidden" name="product_promotion_id" value="<?= $apply['product_promotion_id'] ?>">
                            <input type="hidden" name="promotion_id" id="promotion_id" value="<?= $apply['promotion_id'] ?>">

                            <label class="form-label fw-semibold">Chọn khuyến mãi mới</label>

                            <div class="row g-2">
                                <?php foreach ($listPromotionActive as $pr): ?>
                                    <div class="col-6 col-md-4">
                                        <div class="card promotion-card border 
                                            <?= $pr['promotion_id'] == $apply['promotion_id'] ? 'border-primary' : '' ?>"
                                            onclick="selectPromotion(<?= $pr['promotion_id'] ?>, this)">
                                            <div class="card-body p-2">
                                                <h6 class="card-title mb-1" style="font-size: 14px;"><?= $pr['promotion_name'] ?></h6>
                                                <small class="text-muted">Mã: <?= $pr['promotion_code'] ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="index.php?controller=promotion&action=listAllProductPromotion" class="btn btn-outline-secondary">Quay lại</a>
                                <button type="submit" name="btnUpdateProductPromotion" class="btn btn-primary">Cập nhật</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function selectPromotion(id, card) {
            document.getElementById('promotion_id').value = id;

            document.querySelectorAll('.promotion-card').forEach(c => {
                c.classList.remove('border-primary');
            });

            card.classList.add('border-primary');
        }
    </script>

</body>

</html>
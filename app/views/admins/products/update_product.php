<?php
require_once __DIR__ . '/../../../models/category_model.php';
require_once __DIR__ . '/../../../models/product_model.php';
require_once __DIR__ . '/../../../../config/config.php';

$categoryModel = new CategoryModel();
$listCategory = $categoryModel->getAllCategory();

$productModel = new ProductModel();
$listEnumStatus = $productModel->getValueEnumStatus();

$product_id = $_GET['product_id'];
$oneProduct = $productModel->getByIdProduct($product_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Cập nhật sản phẩm</title>
    <script src="../../../../assets/js/view_image.js"></script>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 0;
        }

        .form-container {
            max-width: 700px;
            margin: 0 auto;
        }

        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .card-header-custom {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }

        .card-header-custom h3 {
            margin: 0;
            font-weight: 600;
            font-size: 24px;
        }

        .card-header-custom p {
            margin: 8px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .card-body-custom {
            padding: 40px;
            background: white;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-label i {
            margin-right: 8px;
            color: #f5576c;
        }

        .form-control,
        .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #f5576c;
            box-shadow: 0 0 0 0.2rem rgba(245, 87, 108, 0.25);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        #preview {
            max-width: 200px;
            border-radius: 12px;
            margin-top: 10px;
            border: 2px solid #e0e0e0;
            padding: 5px;
            background: #f8f9fa;
        }

        .btn-warning-custom {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            transition: transform 0.2s ease;
        }

        .btn-warning-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(245, 87, 108, 0.4);
            color: white;
        }

        .required::after {
            content: " *";
            color: red;
        }

        hr {
            margin: 20px 0;
            border-top: 2px solid #f0f0f0;
        }

        .product-id-badge {
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 12px;
            border-left: 4px solid #f5576c;
            margin-bottom: 20px;
        }

        .current-image-label {
            font-size: 13px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <div class="card card-custom">
            <div class="card-header-custom">
                <h3><i class="fas fa-edit me-2"></i>Cập nhật sản phẩm</h3>
                <p>Chỉnh sửa thông tin sản phẩm</p>
            </div>
            <div class="card-body-custom">
                <form action="index.php?controller=product&action=updateProduct&product_id=<?= $oneProduct['product_id'] ?>" method="post" enctype="multipart/form-data">

                    <!-- Mã sản phẩm -->
                    <div class="product-id-badge">
                        <i class="fas fa-hashtag me-2" style="color: #f5576c;"></i>
                        <strong>Mã sản phẩm:</strong> #<?= $oneProduct['product_id'] ?>
                    </div>

                    <!-- Tên sản phẩm -->
                    <div class="mb-4">
                        <label class="form-label" for="product_name">
                            <i class="fas fa-tag"></i>Tên sản phẩm <span class="required">*</span>
                        </label>
                        <input class="form-control" type="text" id="product_name" name="product_name"
                            value="<?= htmlspecialchars($oneProduct['product_name']) ?>"
                            placeholder="Nhập tên sản phẩm" required>
                    </div>

                    <div class="row">
                        <!-- Giá -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="price">
                                <i class="fas fa-dollar-sign"></i>Giá (VNĐ) <span class="required">*</span>
                            </label>
                            <input class="form-control" type="text" id="price" name="price"
                                value="<?= number_format($oneProduct['price'], 0, ',', '.') ?>"
                                placeholder="Nhập giá sản phẩm" required>
                            <small class="text-muted">Ví dụ: 1.000.000 (một triệu đồng)</small>
                        </div>

                        <!-- Số lượng -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="stock_quantity">
                                <i class="fas fa-boxes"></i>Số lượng <span class="required">*</span>
                            </label>
                            <input class="form-control" type="number" id="stock_quantity" name="stock_quantity"
                                value="<?= $oneProduct['stock_quantity'] ?>"
                                placeholder="Nhập số lượng" required>
                        </div>
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-4">
                        <label class="form-label" for="description">
                            <i class="fas fa-align-left"></i>Mô tả
                        </label>
                        <textarea class="form-control" name="description" id="description"
                            placeholder="Nhập mô tả chi tiết về sản phẩm..."><?= htmlspecialchars($oneProduct['description']) ?></textarea>
                    </div>

                    <!-- Hình ảnh -->
                    <div class="mb-4">
                        <label class="form-label" for="image_url">
                            <i class="fas fa-image"></i>Hình ảnh
                        </label>
                        <input class="form-control" type="file" id="image_url" name="image_url"
                            onchange="ViewImage(event)" accept="image/*">
                        <div class="text-center">
                            <?php if (!empty($oneProduct['image_url'])): ?>
                                <img src="../../../../uploads/<?= $oneProduct['image_url'] ?>"
                                    alt="Hình ảnh hiện tại" id="preview"
                                    style="max-width: 200px; margin-top: 10px; border-radius: 12px;">
                                <div class="current-image-label">
                                    <i class="fas fa-info-circle"></i> Hình ảnh hiện tại
                                </div>
                            <?php else: ?>
                                <img src="" alt="Xem trước hình ảnh" id="preview"
                                    style="display: none; max-width: 200px; margin-top: 10px;">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Trạng thái -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="status">
                                <i class="fas fa-info-circle"></i>Trạng thái
                            </label>
                            <select class="form-select" name="status" id="status">
                                <?php foreach ($listEnumStatus as $status): ?>
                                    <option value="<?= $status ?>" <?= ($status == $oneProduct['status']) ? 'selected' : '' ?>>
                                        <?php
                                        if ($status == 'available')
                                            echo "✅ Còn hàng";
                                        else if ($status == 'out_of_stock')
                                            echo "❌ Tạm hết";
                                        else if ($status == 'discontinued')
                                            echo "🚫 Ngừng kinh doanh";
                                        ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Danh mục -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="category_id">
                                <i class="fas fa-folder"></i>Danh mục <span class="required">*</span>
                            </label>
                            <select class="form-select" name="category_id" id="category_id" required>
                                <?php foreach ($listCategory as $c): ?>
                                    <option value="<?= $c['category_id'] ?>" <?= ($c['category_id'] == $oneProduct['category_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($c['category_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-secondary flex-grow-1" onclick="window.history.back()">
                            <i class="fas fa-arrow-left me-1"></i>Quay lại
                        </button>
                        <button type="submit" name="btnUpdateProduct" class="btn btn-warning-custom flex-grow-1">
                            <i class="fas fa-save me-1"></i>Cập nhật sản phẩm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Format giá khi nhập
        const priceInput = document.getElementById('price');

        if (priceInput) {
            priceInput.addEventListener('input', function(e) {
                let value = this.value.replace(/[^\d]/g, '');
                if (value) {
                    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    this.value = value;
                }
            });

            // Khi submit form, loại bỏ dấu chấm để gửi số nguyên
            document.querySelector('form').addEventListener('submit', function(e) {
                if (priceInput.value) {
                    priceInput.value = priceInput.value.replace(/\./g, '');
                }
            });
        }

        // Cập nhật hàm preview ảnh
        function ViewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>
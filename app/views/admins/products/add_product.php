<?php
require_once __DIR__ . '/../../../models/category_model.php';
require_once __DIR__ . '/../../../models/product_model.php';
require_once __DIR__ . '/../../../../config/config.php';
$category = new CategoryModel();
$listCategory = $category->getAllCategory();

$product = new ProductModel();
$listEnumStatus = $product->getValueEnumStatus();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Thêm sản phẩm</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            color: #667eea;
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
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
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

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: transform 0.2s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .status-badge {
            background: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border-radius: 12px;
            font-weight: 600;
            border: 1px solid #c3e6cb;
        }

        .required::after {
            content: " *";
            color: red;
        }

        hr {
            margin: 20px 0;
            border-top: 2px solid #f0f0f0;
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <div class="card card-custom">
            <div class="card-header-custom">
                <h3><i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm mới</h3>
                <p>Điền đầy đủ thông tin bên dưới</p>
            </div>
            <div class="card-body-custom">
                <form action="../../../index.php?controller=product&action=addProduct" method="post" enctype="multipart/form-data" id="addProductForm">
                    <!-- Tên sản phẩm -->
                    <div class="mb-4">
                        <label class="form-label" for="product_name">
                            <i class="fas fa-tag"></i>Tên sản phẩm <span class="required">*</span>
                        </label>
                        <input class="form-control" type="text" id="product_name" name="product_name"
                            placeholder="Nhập tên sản phẩm" required minlength="3" maxlength="100">
                    </div>

                    <div class="row">
                        <!-- Giá -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="price">
                                <i class="fas fa-dollar-sign"></i>Giá <span class="required">*</span>
                            </label>
                            <input class="form-control" type="number" id="price" name="price"
                                placeholder="Nhập giá sản phẩm" required step="0.01" min="0.01" max="9999999">
                        </div>

                        <!-- Số lượng -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="stock_quantity">
                                <i class="fas fa-boxes"></i>Số lượng <span class="required">*</span>
                            </label>
                            <input class="form-control" type="number" id="stock_quantity" name="stock_quantity"
                                placeholder="Nhập số lượng" required min="0" max="999999">
                        </div>
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-4">
                        <label class="form-label" for="description">
                            <i class="fas fa-align-left"></i>Mô tả
                        </label>
                        <textarea class="form-control" name="description" id="description"
                            placeholder="Nhập mô tả chi tiết về sản phẩm..."></textarea>
                    </div>

                    <!-- Hình ảnh -->
                    <div class="mb-4">
                        <label class="form-label" for="image_url">
                            <i class="fas fa-image"></i>Hình ảnh
                        </label>
                        <input class="form-control" type="file" id="image_url" name="image_url"
                            onchange="ValidateAndPreviewImage(event)" accept="image/*">
                        <small class="form-text text-muted">Định dạng: JPG, PNG, GIF. Kích thước tối đa: 5MB</small>
                        <div class="text-center">
                            <img src="" alt="Xem trước hình ảnh" id="preview" style="display: none; max-width: 200px; margin-top: 10px; border-radius: 12px;">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Trạng thái -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label">
                                <i class="fas fa-info-circle"></i>Trạng thái
                            </label>
                            <div class="status-badge">
                                <i class="fas fa-check-circle me-1"></i>Còn hàng
                            </div>
                            <input type="hidden" name="status" value="available">
                        </div>

                        <!-- Danh mục -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="category_id">
                                <i class="fas fa-folder"></i>Danh mục <span class="required">*</span>
                            </label>
                            <select class="form-select" name="category_id" id="category_id" required>
                                <option value="">-- Chọn danh mục --</option>
                                <?php foreach ($listCategory as $c): ?>
                                    <option value="<?= $c['category_id'] ?>"><?= htmlspecialchars($c['category_name']) ?></option>
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
                        <button type="submit" name="btnAddProduct" class="btn btn-primary-custom flex-grow-1">
                            <i class="fas fa-save me-1"></i>Thêm sản phẩm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Kiểm tra và xem trước ảnh
        function ValidateAndPreviewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            const maxSize = 5 * 1024 * 1024; // 5MB
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (file) {
                // Kiểm tra loại file
                if (!allowedTypes.includes(file.type)) {
                    alert('Vui lòng chọn file ảnh (JPG, PNG, GIF)');
                    event.target.value = '';
                    preview.style.display = 'none';
                    return;
                }

                // Kiểm tra kích thước file
                if (file.size > maxSize) {
                    alert('Kích thước ảnh không được vượt quá 5MB');
                    event.target.value = '';
                    preview.style.display = 'none';
                    return;
                }

                // Xem trước ảnh
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }

        // Xác thực form trước khi submit
        document.getElementById('addProductForm').addEventListener('submit', function(e) {
            const price = parseFloat(document.getElementById('price').value);
            const quantity = parseInt(document.getElementById('stock_quantity').value);
            const categoryId = document.getElementById('category_id').value;

            if (price <= 0) {
                e.preventDefault();
                alert('Giá sản phẩm phải lớn hơn 0');
                return;
            }

            if (quantity < 0) {
                e.preventDefault();
                alert('Số lượng không được âm');
                return;
            }

            if (!categoryId) {
                e.preventDefault();
                alert('Vui lòng chọn danh mục');
                return;
            }
        });
    </script>
</body>

</html>
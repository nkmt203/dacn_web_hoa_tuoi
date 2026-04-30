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
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Admin | Cập nhật sản phẩm</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #e0e7ff 0%, #f1f5f9 100%);
            min-height: 100vh;
            padding: 48px 32px;
            position: relative;
        }

        /* Decorative background */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="10" cy="10" r="2" fill="rgba(59,130,246,0.05)"/><circle cx="85" cy="20" r="3" fill="rgba(59,130,246,0.05)"/><circle cx="50" cy="85" r="4" fill="rgba(59,130,246,0.05)"/></svg>') repeat;
            pointer-events: none;
        }

        .form-container {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* Card chính */
        .form-card {
            background: #ffffff;
            border-radius: 28px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.3);
        }

        /* Header với gradient đẹp */
        .card-header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            padding: 28px 32px;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: "";
            position: absolute;
            top: -30%;
            right: -10%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .card-header::after {
            content: "";
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .card-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin: 0 0 4px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header h2 i {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .card-header p {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
            margin: 12px 0 0 0;
        }

        /* Nút quay lại icon bên phải */
        .btn-back-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            transition: all 0.25s ease;
            text-decoration: none;
            cursor: pointer;
            border: none;
            z-index: 10;
            position: relative;
        }

        .btn-back-icon:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(-4px);
            color: white;
        }

        .btn-back-icon:active {
            transform: translateX(-6px);
        }

        /* Card body */
        .card-body {
            padding: 36px 32px;
        }

        /* Grid layout */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px 28px;
        }

        .full-width {
            grid-column: span 2;
        }

        /* Form group */
        .form-group {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .form-label i {
            margin-right: 8px;
            color: #3b82f6;
            font-size: 0.9rem;
        }

        .required {
            color: #ef4444;
            margin-left: 3px;
        }

        /* Input fields */
        .form-control {
            width: 100%;
            padding: 12px 16px;
            font-size: 0.9rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            transition: all 0.2s ease;
            background: #f8fafc;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .form-control.error {
            border-color: #ef4444;
            background: #fef2f2;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        select.form-control {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
            appearance: none;
        }

        .error-msg {
            font-size: 0.7rem;
            color: #ef4444;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .helper-text {
            font-size: 0.7rem;
            color: #64748b;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Product ID Badge */
        .product-id-badge {
            background: #f8fafc;
            padding: 12px 20px;
            border-radius: 16px;
            border-left: 4px solid #3b82f6;
            margin-bottom: 28px;
            font-size: 0.85rem;
            color: #1e293b;
        }

        .product-id-badge i {
            color: #3b82f6;
            margin-right: 8px;
        }

        /* Upload area */
        .upload-area {
            border: 1.5px dashed #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #f8fafc;
        }

        .upload-area:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .upload-area i {
            font-size: 2rem;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .upload-area:hover i {
            color: #3b82f6;
        }

        .upload-area p {
            margin: 0;
            font-size: 0.8rem;
            color: #64748b;
        }

        .upload-area small {
            font-size: 0.65rem;
            color: #94a3b8;
        }

        #preview {
            max-width: 380px;
            max-height: 380px;
            object-fit: cover;
            border-radius: 16px;
            margin-top: 16px;
        }

        /* Image preview container */
        .image-preview-container {
            text-align: center;
        }

        /* Nút xóa ảnh */
        .btn-remove-image {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 8px 20px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.8rem;
            transition: all 0.2s ease;
            cursor: pointer;
            margin-top: 12px;
        }

        .btn-remove-image:hover {
            background: #dc2626;
            color: white;
            transform: translateY(-2px);
        }

        /* Status badge */
        .status-badge {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #059669;
            padding: 12px 20px;
            border-radius: 16px;
            font-weight: 500;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Divider */
        .divider {
            margin: 32px 0 28px;
            position: relative;
            text-align: center;
        }

        .divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, #e2e8f0, transparent);
        }

        .divider span {
            position: relative;
            background: white;
            padding: 0 16px;
            font-size: 0.7rem;
            color: #94a3b8;
        }

        /* Button group */
        .button-group {
            display: flex;
            gap: 16px;
            margin-top: 8px;
        }

        /* Submit button */
        .btn-submit {
            flex: 1;
            padding: 12px 24px;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 60px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            transform: none;
            box-shadow: none;
            cursor: not-allowed;
        }

        /* Back button footer */
        .btn-back-footer {
            padding: 12px 28px;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 60px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #475569;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back-footer:hover {
            background: #e2e8f0;
            border-color: #cbd5e1;
            color: #1e293b;
            transform: translateY(-1px);
        }

        /* Animation */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-4px);
            }

            75% {
                transform: translateX(4px);
            }
        }

        .shake {
            animation: shake 0.2s ease-in-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-card {
            animation: fadeInUp 0.5s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 20px 16px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .full-width {
                grid-column: span 1;
            }

            .card-header {
                padding: 20px 24px;
            }

            .card-header h2 {
                font-size: 1.2rem;
            }

            .card-body {
                padding: 28px 24px;
            }

            .button-group {
                flex-direction: column;
                gap: 12px;
            }

            .btn-back-footer {
                justify-content: center;
            }

            .btn-back-icon {
                width: 36px;
                height: 36px;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form-card">
            <!-- Header với nút quay lại bên phải -->
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">
                        <i class="fas fa-edit"></i>
                        Cập nhật sản phẩm
                    </h2>
                    <a href="index.php?controller=product&action=listProduct" class="btn-back-icon" title="Quay lại danh sách">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <p class="mb-0 mt-2">Chỉnh sửa thông tin chi tiết của sản phẩm</p>
            </div>

            <!-- Form Body -->
            <div class="card-body">
                <form action="index.php?controller=product&action=updateProduct&product_id=<?= $oneProduct['product_id'] ?>"
                    method="post"
                    enctype="multipart/form-data"
                    id="updateProductForm">

                    <!-- Mã sản phẩm Badge -->
                    <div class="product-id-badge">
                        <i class="fas fa-hashtag"></i>
                        <strong>Mã sản phẩm:</strong> #<?= $oneProduct['product_id'] ?>
                    </div>

                    <div class="form-grid">
                        <!-- Tên sản phẩm -->
                        <div class="full-width form-group">
                            <label class="form-label">
                                <i class="fas fa-tag"></i>Tên sản phẩm <span class="required">*</span>
                            </label>
                            <input type="text"
                                class="form-control"
                                id="product_name"
                                name="product_name"
                                value="<?= htmlspecialchars($oneProduct['product_name']) ?>"
                                placeholder="Ví dụ: Hoa hồng đỏ tình yêu">
                            <div class="error-msg" id="product_name_error"></div>
                        </div>

                        <!-- Giá bán - step="any" cho phép nhập bất kỳ số nào -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-dollar-sign"></i>Giá bán <span class="required">*</span>
                            </label>
                            <input type="number"
                                class="form-control"
                                id="price"
                                name="price"
                                value="<?= $oneProduct['price'] ?>"
                                placeholder="0"
                                step="any"
                                min="0">
                            <div class="error-msg" id="price_error"></div>
                            <div class="helper-text">VNĐ - Ví dụ: 15000, 25000, 2222</div>
                        </div>

                        <!-- Số lượng -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-boxes"></i>Số lượng tồn kho <span class="required">*</span>
                            </label>
                            <input type="number"
                                class="form-control"
                                id="stock_quantity"
                                name="stock_quantity"
                                value="<?= $oneProduct['stock_quantity'] ?>"
                                placeholder="0"
                                min="0">
                            <div class="error-msg" id="stock_quantity_error"></div>
                        </div>

                        <!-- Danh mục -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-folder"></i>Danh mục <span class="required">*</span>
                            </label>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="">-- Chọn danh mục --</option>
                                <?php foreach ($listCategory as $c): ?>
                                    <option value="<?= $c['category_id'] ?>" <?= ($c['category_id'] == $oneProduct['category_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($c['category_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="error-msg" id="category_id_error"></div>
                        </div>

                        <!-- Trạng thái -->
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-info-circle"></i>Trạng thái</label>
                            <select class="form-control" name="status" id="status">
                                <?php foreach ($listEnumStatus as $status): ?>
                                    <option value="<?= $status ?>" <?= ($status == $oneProduct['status']) ? 'selected' : '' ?>>
                                        <?php
                                        if ($status == 'available') echo "✅ Còn hàng";
                                        else if ($status == 'out_of_stock') echo "⏳ Tạm hết";
                                        else if ($status == 'discontinued') echo "❌ Ngừng kinh doanh";
                                        ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Mô tả -->
                        <div class="full-width form-group">
                            <label class="form-label">
                                <i class="fas fa-align-left"></i>Mô tả sản phẩm
                            </label>
                            <textarea class="form-control"
                                name="description"
                                id="description"
                                rows="5"
                                placeholder="Nhập mô tả chi tiết về sản phẩm..."><?= htmlspecialchars($oneProduct['description']) ?></textarea>
                        </div>

                        <!-- Hình ảnh -->
                        <div class="full-width form-group">
                            <label class="form-label">
                                <i class="fas fa-image"></i>Hình ảnh sản phẩm
                            </label>
                            <div class="upload-area" onclick="document.getElementById('image_url').click()">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Click để tải lên hình ảnh</p>
                                <small>JPG, PNG, GIF, WEBP (Tối đa 5MB)</small>
                            </div>
                            <input type="file"
                                id="image_url"
                                name="image_url"
                                accept="image/jpeg,image/png,image/gif,image/webp"
                                style="display: none;">

                            <!-- Khu vực hiển thị ảnh -->
                            <div class="image-preview-container">
                                <?php if (!empty($oneProduct['image_url'])): ?>
                                    <div>
                                        <img src="../../../../uploads/<?= $oneProduct['image_url'] ?>"
                                            alt="Xem trước"
                                            id="preview"
                                            style="max-width: 380px; max-height: 380px; border-radius: 16px; border: 2px solid #e2e8f0; margin-top: 16px;">
                                        <div class="mt-2">
                                            <button type="button"
                                                id="btnRemoveImage"
                                                class="btn-remove-image">
                                                <i class="fas fa-trash-alt me-2"></i>Xóa ảnh
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="remove_image" id="remove_image" value="0">
                                <?php else: ?>
                                    <img src="" alt="Xem trước" id="preview" style="display: none; max-width: 380px; max-height: 380px; border-radius: 16px; margin-top: 16px;">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="divider">
                        <span>THÔNG TIN SẢN PHẨM</span>
                    </div>

                    <!-- Button group -->
                    <div class="button-group">
                        <a href="index.php?controller=product&action=listProduct" class="btn-back-footer">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" name="btnUpdateProduct" class="btn-submit" id="submitBtn">
                            <i class="fas fa-save"></i> Cập nhật sản phẩm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // DOM elements
        const form = document.getElementById('updateProductForm');
        const productName = document.getElementById('product_name');
        const priceInput = document.getElementById('price');
        const stockQuantity = document.getElementById('stock_quantity');
        const categoryId = document.getElementById('category_id');
        const imageInput = document.getElementById('image_url');
        const preview = document.getElementById('preview');
        const btnRemoveImage = document.getElementById('btnRemoveImage');
        const removeImageHidden = document.getElementById('remove_image');

        // Helper functions
        function showError(input, message) {
            const errorDiv = document.getElementById(input.id + '_error');
            if (errorDiv) {
                errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                input.classList.add('error');
                input.classList.remove('success');
            }
        }

        function clearError(input) {
            const errorDiv = document.getElementById(input.id + '_error');
            if (errorDiv) {
                errorDiv.innerHTML = '';
                input.classList.remove('error');
                input.classList.add('success');
            }
        }

        // ========== Validation ==========
        function validateProductName() {
            const value = productName.value.trim();
            if (!value) {
                showError(productName, 'Vui lòng nhập tên sản phẩm');
                return false;
            }
            if (value.length < 3) {
                showError(productName, 'Tên sản phẩm phải có ít nhất 3 ký tự');
                return false;
            }
            if (value.length > 100) {
                showError(productName, 'Tên sản phẩm không được quá 100 ký tự');
                return false;
            }
            clearError(productName);
            return true;
        }

        function validatePrice() {
            const value = parseFloat(priceInput.value);
            if (isNaN(value) || priceInput.value === '') {
                showError(priceInput, 'Vui lòng nhập giá sản phẩm');
                return false;
            }
            if (value < 1000) {
                showError(priceInput, 'Giá sản phẩm phải từ 1.000đ trở lên');
                return false;
            }
            if (value > 999999999) {
                showError(priceInput, 'Giá sản phẩm không được quá 999.999.999đ');
                return false;
            }
            clearError(priceInput);
            return true;
        }

        function validateStockQuantity() {
            const value = parseInt(stockQuantity.value);
            if (isNaN(value)) {
                showError(stockQuantity, 'Vui lòng nhập số lượng');
                return false;
            }
            if (value < 0) {
                showError(stockQuantity, 'Số lượng không thể âm');
                return false;
            }
            clearError(stockQuantity);
            return true;
        }

        function validateCategory() {
            const value = categoryId.value;
            if (!value) {
                showError(categoryId, 'Vui lòng chọn danh mục');
                return false;
            }
            clearError(categoryId);
            return true;
        }

        // Real-time validation
        productName.addEventListener('input', validateProductName);
        productName.addEventListener('blur', validateProductName);
        priceInput.addEventListener('input', validatePrice);
        priceInput.addEventListener('blur', validatePrice);
        stockQuantity.addEventListener('input', validateStockQuantity);
        stockQuantity.addEventListener('blur', validateStockQuantity);
        categoryId.addEventListener('change', validateCategory);

        function shakeElement(el) {
            el.classList.add('shake');
            setTimeout(() => el.classList.remove('shake'), 200);
        }

        // ========== Upload ảnh ==========
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const maxSize = 5 * 1024 * 1024;
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

                if (file) {
                    if (!allowedTypes.includes(file.type)) {
                        alert('Vui lòng chọn file ảnh đúng định dạng (JPG, PNG, GIF, WEBP)');
                        this.value = '';
                        return;
                    }
                    if (file.size > maxSize) {
                        alert('Kích thước ảnh không được vượt quá 5MB');
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                        preview.style.maxWidth = '200px';
                        preview.style.maxHeight = '200px';

                        // Ẩn nút xóa ảnh cũ nếu có
                        const removeBtn = document.getElementById('btnRemoveImage');
                        if (removeBtn) {
                            removeBtn.style.display = 'none';
                        }

                        // Cập nhật hidden input để không xóa ảnh cũ
                        if (removeImageHidden) {
                            removeImageHidden.value = '0';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Xóa ảnh hiện tại
        if (btnRemoveImage && removeImageHidden) {
            btnRemoveImage.addEventListener('click', function() {
                if (confirm('Bạn có chắc muốn xóa ảnh hiện tại của sản phẩm này?')) {
                    removeImageHidden.value = '1';
                    preview.style.display = 'none';
                    preview.src = '';
                    this.style.display = 'none';
                }
            });
        }

        // ========== Submit ==========
        form.addEventListener('submit', function(e) {
            const isValid = validateProductName() && validatePrice() && validateStockQuantity() && validateCategory();

            if (!isValid) {
                e.preventDefault();
                if (!validateProductName()) shakeElement(productName);
                else if (!validatePrice()) shakeElement(priceInput);
                else if (!validateStockQuantity()) shakeElement(stockQuantity);
                else if (!validateCategory()) shakeElement(categoryId);
                return;
            }

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-pulse me-2"></i>Đang xử lý...';
        });
    </script>
</body>

</html>
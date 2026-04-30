<?php
require_once __DIR__ . '/../../../models/category_model.php';
require_once __DIR__ . '/../../../../config/config.php';

$category_id = $_GET['category_id'];
$categoryModel = new CategoryModel();
$oneCategory = $categoryModel->getByIdCategory($category_id);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Admin | Cập nhật danh mục</title>

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
            max-width: 700px;
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

        /* Form group */
        .form-group {
            margin-bottom: 28px;
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

        /* Category ID Badge */
        .category-id-badge {
            background: #f8fafc;
            padding: 12px 20px;
            border-radius: 16px;
            border-left: 4px solid #3b82f6;
            margin-bottom: 28px;
            font-size: 0.85rem;
            color: #1e293b;
        }

        .category-id-badge i {
            color: #3b82f6;
            margin-right: 8px;
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
                        <i class="fas fa-folder-plus"></i>
                        Cập nhật danh mục
                    </h2>
                    <a href="index.php?controller=category&action=listCategory" class="btn-back-icon" title="Quay lại danh sách">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <p class="mb-0 mt-2">Chỉnh sửa thông tin chi tiết của danh mục</p>
            </div>

            <!-- Form Body -->
            <div class="card-body">
                <form action="index.php?controller=category&action=updateCategory&category_id=<?= $oneCategory['category_id'] ?>"
                    method="post"
                    enctype="multipart/form-data"
                    id="updateCategoryForm">

                    <!-- Mã danh mục Badge -->
                    <div class="category-id-badge">
                        <i class="fas fa-hashtag"></i>
                        <strong>Mã danh mục:</strong> #<?= $oneCategory['category_id'] ?>
                    </div>

                    <!-- Tên danh mục -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-tag"></i>Tên danh mục <span class="required">*</span>
                        </label>
                        <input type="text"
                            class="form-control"
                            id="category_name"
                            name="category_name"
                            value="<?= htmlspecialchars($oneCategory['category_name']) ?>"
                            placeholder="Ví dụ: Hoa hồng, Hoa cúc, Hoa lan...">
                        <div class="error-msg" id="category_name_error"></div>
                        <div class="helper-text">
                            <i class="fas fa-info-circle me-1"></i>Từ 3-100 ký tự, không được để trống
                        </div>
                    </div>

                    <!-- Mô tả -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-align-left"></i>Mô tả danh mục
                        </label>
                        <textarea class="form-control"
                            name="description"
                            id="description"
                            rows="7"
                            placeholder="Nhập mô tả chi tiết về danh mục..."><?= htmlspecialchars($oneCategory['description']) ?></textarea>
                        <div class="helper-text">
                            <i class="fas fa-pen-fancy me-1"></i>Mô tả càng chi tiết càng tốt (không bắt buộc)
                        </div>
                    </div>

                    <div class="divider">
                        <span>THÔNG TIN DANH MỤC</span>
                    </div>

                    <!-- Button group -->
                    <div class="button-group">
                        <a href="index.php?controller=category&action=listCategory" class="btn-back-footer">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" name="btnUpdateCategory" class="btn-submit" id="submitBtn">
                            <i class="fas fa-save"></i> Cập nhật danh mục
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // DOM elements
        const form = document.getElementById('updateCategoryForm');
        const categoryName = document.getElementById('category_name');
        const submitBtn = document.getElementById('submitBtn');

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

        // Validate tên danh mục
        function validateCategoryName() {
            const value = categoryName.value.trim();
            if (!value) {
                showError(categoryName, 'Vui lòng nhập tên danh mục');
                return false;
            }
            if (value.length < 3) {
                showError(categoryName, 'Tên danh mục phải có ít nhất 3 ký tự');
                return false;
            }
            if (value.length > 100) {
                showError(categoryName, 'Tên danh mục không được quá 100 ký tự');
                return false;
            }
            clearError(categoryName);
            return true;
        }

        // Real-time validation
        categoryName.addEventListener('input', validateCategoryName);
        categoryName.addEventListener('blur', validateCategoryName);

        // Shake animation
        function shakeElement(el) {
            el.classList.add('shake');
            setTimeout(() => el.classList.remove('shake'), 200);
        }

        // ========== Submit ==========
        form.addEventListener('submit', function(e) {
            const isValid = validateCategoryName();

            if (!isValid) {
                e.preventDefault();
                shakeElement(categoryName);
                categoryName.focus();
                return;
            }

           // submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-pulse me-2"></i>Đang xử lý...';
        });
    </script>
</body>

</html>
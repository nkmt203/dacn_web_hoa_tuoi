<!DOCTYPE html>
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($product['product_name']) ?> - Bloom & Co</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@400;500;600&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: #fdfaf7;
        }

        .heading-font {
            font-family: 'Playfair Display', serif;
        }

        /* container thu nhỏ, thoáng hơn */
        .main-container {
            max-width: 1000px;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* giảm khoảng cách dọc, tạo cảm giác gọn nhưng vẫn thoáng */
        .product-info {
            background: white;
            border-radius: 24px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            padding: 1.6rem 1.8rem;
            transition: all 0.2s;
        }

        /* ảnh bo góc nhẹ, kích thước cân đối */
        .product-image img {
            border-radius: 24px;
            transition: transform 0.4s ease;
            max-height: 540px;
            width: 100%;
            object-fit: cover;
        }

        .product-image:hover img {
            transform: scale(1.02);
        }

        /* tiêu đề sản phẩm nhỏ hơn 1 chút nhưng vẫn nổi bật */
        .product-title {
            font-size: 1.85rem;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        /* giá chính */
        .price {
            font-size: 2rem;
            font-weight: 800;
            color: #e05a7e;
        }

        .original-price {
            font-size: 1.1rem;
            text-decoration: line-through;
            color: #aaa;
        }

        /* button thêm giỏ hàng - gọn hơn nhưng vẫn dễ bấm */
        .btn-add-cart {
            background: linear-gradient(135deg, #e05a7e, #c4456c);
            border: none;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 40px;
            transition: all 0.25s;
        }

        .btn-add-cart:hover {
            background: linear-gradient(135deg, #c4456c, #e05a7e);
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(224, 90, 126, 0.25);
        }

        /* nút wishlist tròn nhỏ gọn */
        .btn-wishlist {
            width: 48px;
            height: 48px;
            border-radius: 60px;
            border: 1.5px solid #e2e2e2;
            background: white;
            transition: all 0.2s;
        }
        .btn-wishlist:hover {
            background: #fff0f3;
            border-color: #e05a7e;
        }

        .trust-item i {
            font-size: 1.6rem;
        }
        .trust-item p {
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* các khoảng cách margin/padding được thu gọn nhưng giữ bố cục đẹp mắt */
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* header thu nhỏ padding, gọn hơn */
        .custom-header {
            padding: 0.65rem 0;
        }

        /* tùy chỉnh input số lượng nhỏ gọn hơn */
        .qty-group {
            width: 136px;
        }
        .qty-group input {
            padding: 0.4rem 0;
            font-size: 0.95rem;
        }
        .qty-group button {
            padding: 0.4rem 0.85rem;
        }

        /* điều chỉnh breadcrumb gọn hơn */
        .breadcrumb {
            margin-bottom: 1.2rem;
            font-size: 0.85rem;
        }
        
        /* giảm khoảng cách giữa các hàng trong mô tả */
        .product-description {
            font-size: 0.95rem;
            line-height: 1.55;
        }
        
        @media (max-width: 768px) {
            .product-info {
                padding: 1.25rem;
            }
            .product-title {
                font-size: 1.6rem;
            }
            .price {
                font-size: 1.8rem;
            }
            .btn-add-cart {
                padding: 10px 18px;
            }
        }
        
        /* giữ hiệu ứng và màu sắc tự nhiên */
        .text-pink-400 {
            color: #e05a7e;
        }
        .bg-soft-pink {
            background-color: #fff3f5;
        }
        .hover-lift {
            transition: transform 0.2s ease;
        }
        
        /* Animations */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            opacity: 0;
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
    </style>
</head>

<body class="animate-fade-up">

    <!-- Header thu nhỏ hơn: padding dọc giảm, thanh tìm kiếm nhỏ gọn nhưng vẫn đầy đủ chức năng -->
    <header class="bg-white border-bottom sticky-top shadow-sm">
        <div class="container py-2 custom-header">
            <div class="row align-items-center g-2">
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-flower1 fs-3 text-pink-400"></i>
                        <span class="heading-font fs-5 fw-bold">Bloom & Co</span>
                    </div>
                </div>
                <div class="col-md-5 col-12 mt-2 mt-md-0">
                    <input type="text" class="form-control form-control-sm rounded-pill" placeholder="Tìm kiếm hoa tươi...">
                </div>
                <div class="col-md-4 col-6 text-end">
                    <a href="#" class="me-3 text-dark fs-5"><i class="bi bi-heart"></i></a>
                    <?php
                    $cartCount = 0;
                    if (isset($_SESSION['customer'])) {
                        require_once __DIR__ . '/../../models/cart_model.php';
                        $cartModel = new CartModel();
                        $cartCount = $cartModel->getCartCount($_SESSION['customer']['customer_id']);
                    }
                    ?>
                    <a href="index.php?router=customers&controller=cart&action=listCart" class="me-3 text-dark fs-5 position-relative">
                        <i class="bi bi-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill" style="font-size: 0.7rem;"><?= $cartCount ?></span>
                    </a>
                    <?php if (isset($_SESSION['customer'])): ?>
                        <span class="small fw-medium">Xin chào, <?= htmlspecialchars($_SESSION['customer']['username']) ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div class="container main-container py-4">
        <!-- Breadcrumb nhỏ gọn -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-3">
                <li class="breadcrumb-item"><a href="index.php?router=customers&controller=index&action=index" class="text-decoration-none text-secondary">Trang chủ</a></li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page"><?= htmlspecialchars($product['product_name']) ?></li>
            </ol>
        </nav>

        <div class="row g-4 animate-fade-up delay-100">
            <!-- Cột ảnh sản phẩm, kích thước cân đối -->
            <div class="col-lg-6">
                <div class="product-image bg-white rounded-4 overflow-hidden shadow-sm">
                    <img src="uploads/<?= htmlspecialchars($product['image_url']) ?>"
                        class="img-fluid w-100"
                        alt="<?= htmlspecialchars($product['product_name']) ?>"
                        onerror="this.src='https://placehold.co/600x600/pink/white?text=No+Image';">
                </div>
            </div>

            <!-- Thông tin chi tiết (đã thu gọn padding và spacing) -->
            <div class="col-lg-6">
                <div class="product-info h-100 d-flex flex-column">
                    <div>
                        <p class="text-uppercase small text-muted mb-1"><?= htmlspecialchars($category['category_name']) ?></p>
                        <h1 class="product-title heading-font mb-2">
                            <?= htmlspecialchars($product['product_name']) ?>
                        </h1>
                        
                        <!-- Rating gọn nhẹ -->
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="text-warning">★★★★☆</span>
                            <small class="text-muted">(128 đánh giá)</small>
                        </div>

                        <!-- Giá: thiết kế không thay đổi logic -->
                        <div class="mb-3">
                            <?php if (isset($product['discounted_price'])): ?>
                                <span class="price me-2"><?= number_format($product['discounted_price'], 0, ',', '.') ?>đ</span>
                                <span class="original-price"><?= number_format($product['price'], 0, ',', '.') ?>đ</span>
                            <?php else: ?>
                                <span class="price"><?= number_format($product['price'], 0, ',', '.') ?>đ</span>
                            <?php endif; ?>
                        </div>

                        <!-- Tình trạng kho, hiển thị nhỏ gọn -->
                        <div class="mb-3">
                            <?php if ($product['stock_quantity'] > 0): ?>
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fs-6 fw-medium">
                                    <i class="bi bi-check-circle-fill me-1"></i> Còn <?= $product['stock_quantity'] ?> sản phẩm
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                    <i class="bi bi-x-circle-fill me-1"></i> Hết hàng
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Form thêm giỏ hàng giữ nguyên logic, chỉ giảm kích thước các thành phần -->
                    <form action="index.php?controller=cart&action=addCart" method="POST" class="mt-2">
                        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">

                        <!-- Chọn số lượng - nhóm gọn hơn -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-secondary">Số lượng</label>
                            <div class="input-group qty-group">
                                <button type="button" class="btn btn-outline-secondary rounded-start-3" onclick="changeQty(-1)">−</button>
                                <input type="number" id="quantity" name="quantity" 
                                       class="form-control text-center border-secondary-subtle" 
                                       value="1" min="1" max="<?= $product['stock_quantity'] ?>">
                                <button type="button" class="btn btn-outline-secondary rounded-end-3" onclick="changeQty(1)">+</button>
                            </div>
                        </div>

                        <!-- Hàng nút bấm: thêm vào giỏ & yêu thích -->
                        <div class="d-flex gap-3 align-items-center">
                            <button type="submit" class="btn btn-add-cart text-white flex-grow-1 d-flex align-items-center justify-content-center gap-2" 
                                    <?= $product['stock_quantity'] <= 0 ? 'disabled' : '' ?>>
                                <i class="bi bi-cart-plus fs-5"></i> Thêm vào giỏ
                            </button>
                            <button type="button" class="btn-wishlist d-flex align-items-center justify-content-center" aria-label="Yêu thích">
                                <i class="bi bi-heart text-danger fs-5"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Trust badges: giảm padding text, gọn hơn nhưng vẫn đủ nổi bật -->
                    <div class="row mt-4 g-2 text-center pt-2 border-top">
                        <div class="col-4 trust-item">
                            <i class="bi bi-truck text-success fs-5"></i>
                            <p class="mb-0 mt-1 small fw-semibold">Giao nhanh 1-2 ngày</p>
                        </div>
                        <div class="col-4 trust-item">
                            <i class="bi bi-flower1 text-pink-400 fs-5"></i>
                            <p class="mb-0 mt-1 small fw-semibold">Hoa tươi 100%</p>
                        </div>
                        <div class="col-4 trust-item">
                            <i class="bi bi-shield-check text-success fs-5"></i>
                            <p class="mb-0 mt-1 small fw-semibold">Đảm bảo chất lượng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mô tả chi tiết - font chữ dễ đọc, giảm khoảng cách trên dưới -->
        <div class="mt-5">
            <div class="product-info p-4">
                <h2 class="section-title heading-font mb-3">🌸 Chi tiết sản phẩm</h2>
                <div class="text-secondary product-description">
                    <?= nl2br(htmlspecialchars($product['description'])) ?>
                </div>
            </div>
        </div>
        
        <!-- gợi ý nhẹ: có thể thêm phần sản phẩm liên quan (tuỳ chỉnh sau) nhưng giữ layout gọn -->
        <div class="mt-4 text-center small text-muted">
            <i class="bi bi-flower2 me-1"></i> Bloom & Co – Mang thiên nhiên vào từng góc nhỏ
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function changeQty(n) {
            let input = document.getElementById('quantity');
            if (!input) return;
            let value = parseInt(input.value);
            if (isNaN(value)) value = 1;
            value = value + n;
            let min = parseInt(input.min) || 1;
            let max = parseInt(input.max);
            if (value < min) value = min;
            if (!isNaN(max) && value > max) value = max;
            input.value = value;
        }

        // Optional: tự động đồng bộ và ngăn người dùng nhập số vượt quá tồn kho hoặc nhỏ hơn 1
        document.addEventListener('DOMContentLoaded', function() {
            let qtyInput = document.getElementById('quantity');
            if (qtyInput) {
                qtyInput.addEventListener('change', function() {
                    let val = parseInt(this.value);
                    let min = parseInt(this.min) || 1;
                    let max = parseInt(this.max);
                    if (isNaN(val)) val = min;
                    if (val < min) this.value = min;
                    if (!isNaN(max) && val > max) this.value = max;
                });
            }
        });
    </script>
</body>
</html>
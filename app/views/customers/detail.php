<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
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

        .main-container {
            max-width: 1100px;
        }

        .product-image img {
            border-radius: 20px;
            transition: transform 0.5s ease;
        }

        .product-image:hover img {
            transform: scale(1.03);
        }

        .product-info {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
            padding: 2rem;
        }

        .product-title {
            font-size: 2.1rem;
            line-height: 1.2;
        }

        .price {
            font-size: 2.4rem;
            font-weight: 700;
            color: #e05a7e;
        }

        .original-price {
            font-size: 1.25rem;
            text-decoration: line-through;
            color: #999;
        }

        .btn-add-cart {
            background: linear-gradient(135deg, #e05a7e, #c4456c);
            border: none;
            padding: 14px 28px;
            font-size: 1.05rem;
            font-weight: 600;
            border-radius: 50px;
        }

        .btn-add-cart:hover {
            background: linear-gradient(135deg, #c4456c, #e05a7e);
            transform: translateY(-2px);
        }

        .btn-wishlist {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 2px solid #ddd;
            font-size: 1.3rem;
        }

        .trust-item {
            font-size: 0.95rem;
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <!-- Header đơn giản & gọn -->
    <header class="bg-white border-bottom sticky-top">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-flower1 fs-2 text-pink-400"></i>
                        <span class="heading-font fs-4 fw-bold">Bloom & Co</span>
                    </div>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control rounded-pill" placeholder="Tìm kiếm hoa tươi...">
                </div>
                <div class="col-md-4 text-end">
                    <a href="#" class="me-4 text-dark fs-4"><i class="bi bi-heart"></i></a>
                    <a href="#" class="me-4 text-dark fs-4 position-relative">
                        <i class="bi bi-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill">2</span>
                    </a>
                    <?php if (isset($_SESSION['customer'])): ?>
                        <span class="me-2">Xin chào, <?= htmlspecialchars($_SESSION['customer']['username']) ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div class="container main-container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?router=customers&controller=index&action=index" class="text-decoration-none">Trang chủ</a></li>
                <li class="breadcrumb-item active"><?= htmlspecialchars($product['product_name']) ?></li>
            </ol>
        </nav>

        <div class="row g-5">
            <!-- Ảnh sản phẩm -->
            <div class="col-lg-6">
                <div class="product-image">
                    <img src="uploads/<?= htmlspecialchars($product['image_url']) ?>"
                        class="img-fluid w-100 shadow-sm"
                        alt="<?= htmlspecialchars($product['product_name']) ?>"
                        onerror="this.src='https://placehold.co/600x600/pink/white?text=No+Image';">
                </div>
            </div>

            <!-- Thông tin -->
            <div class="col-lg-6">
                <div class="product-info">
                    <h1 class="product-title heading-font fw-semibold mb-2">
                        <?= htmlspecialchars($product['product_name']) ?>
                    </h1>
                    <p class="text-muted"><?= htmlspecialchars($category['category_name']) ?></p>

                    <!-- Rating -->
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="text-warning fs-5">★★★★☆</span>
                        <small class="text-muted">(128 đánh giá)</small>
                    </div>

                    <!-- Giá -->
                    <div class="mb-4">
                        <?php if (isset($product['discounted_price'])): ?>
                            <span class="price"><?= number_format($product['discounted_price'], 0, ',', '.') ?>đ</span>
                            <span class="original-price ms-3"><?= number_format($product['price'], 0, ',', '.') ?>đ</span>
                        <?php else: ?>
                            <span class="price"><?= number_format($product['price'], 0, ',', '.') ?>đ</span>
                        <?php endif; ?>
                    </div>

                    <!-- Kho hàng -->
                    <div class="mb-4">
                        <?php if ($product['stock_quantity'] > 0): ?>
                            <span class="text-success fw-medium">
                                <i class="bi bi-check-circle-fill"></i> Còn <?= $product['stock_quantity'] ?> sản phẩm
                            </span>
                        <?php else: ?>
                            <span class="text-danger"><i class="bi bi-x-circle-fill"></i> Hết hàng</span>
                        <?php endif; ?>
                    </div>

                    <!-- Số lượng -->
                    <div class="mb-4">
                        <label class="form-label fw-medium">Số lượng</label>
                        <div class="input-group" style="width: 160px;">
                            <button class="btn btn-outline-secondary" onclick="changeQty(-1)">−</button>
                            <input type="number" id="quantity" class="form-control text-center" value="1" min="1"
                                max="<?= $product['stock_quantity'] ?>">
                            <button class="btn btn-outline-secondary" onclick="changeQty(1)">+</button>
                        </div>
                    </div>

                    <!-- Nút mua -->
                    <div class="d-flex gap-3">
                        <button class="btn btn-add-cart text-white flex-grow-1"
                            <?= $product['stock_quantity'] <= 0 ? 'disabled' : '' ?>>
                            <i class="bi bi-cart-plus me-2"></i> Thêm vào giỏ hàng
                        </button>
                        <button class="btn btn-wishlist d-flex align-items-center justify-content-center">
                            <i class="bi bi-heart text-danger"></i>
                        </button>
                    </div>

                    <!-- Trust -->
                    <div class="row mt-5 g-3 text-center">
                        <div class="col-4 trust-item">
                            <i class="bi bi-truck text-success fs-4"></i>
                            <p class="mb-0 mt-1 small">Giao nhanh 1-2 ngày</p>
                        </div>
                        <div class="col-4 trust-item">
                            <i class="bi bi-flower1 text-pink-400 fs-4"></i>
                            <p class="mb-0 mt-1 small">Hoa tươi 100%</p>
                        </div>
                        <div class="col-4 trust-item">
                            <i class="bi bi-shield-check text-success fs-4"></i>
                            <p class="mb-0 mt-1 small">Đảm bảo chất lượng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mô tả -->
        <div class="mt-5">
            <div class="product-info">
                <h2 class="section-title heading-font">Chi tiết sản phẩm</h2>
                <div class="text-muted lh-lg">
                    <?= nl2br(htmlspecialchars($product['description'])) ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function changeQty(n) {
            let input = document.getElementById('quantity');
            let value = parseInt(input.value);
            value = value + n;
            if (value < 1) value = 1;
            if (value > parseInt(input.max)) value = input.max;
            input.value = value;
        }
    </script>
</body>

</html>
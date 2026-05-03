<?php

/** @var array $product */
/** @var array $category */
?>
<!DOCTYPE html>
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?= htmlspecialchars($product['product_name']) ?> - FlowerTown</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #e91e63;
            --primary-gradient: linear-gradient(135deg, #e91e63, #c2185b);
            --secondary-color: #C2185B;
            --accent-color: #F06292;
            --bg-color: #FFF5F7;
            --card-bg: #ffffff;
            --text-main: #2d2a24;
            --text-muted: #6b5a4c;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --radius-lg: 32px;
            --radius-md: 16px;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 12px 30px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            line-height: 1.6;
        }

        .heading-font {
            font-family: 'Playfair Display', serif;
        }

        /* Modern Header */
        .header {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .logo i {
            -webkit-text-fill-color: var(--secondary-color);
            font-size: 1.8rem;
        }

        .header-icons a {
            color: var(--text-main);
            font-size: 1.4rem;
            transition: var(--transition);
            position: relative;
            display: flex;
            align-items: center;
            text-decoration: none;
            margin-left: 1.2rem;
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
        }

        /* Main Container */
        .product-detail-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(0, 0, 0, 0.02);
            margin-top: 2rem;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .product-image-container {
            padding: 2rem;
            background: #faf7f2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image-container img {
            border-radius: var(--radius-md);
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .product-image-container:hover img {
            transform: scale(1.02);
        }

        .product-info-container {
            padding: 2rem 2.5rem;
        }

        .breadcrumb {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
        }

        .breadcrumb a {
            color: var(--accent-color);
            text-decoration: none;
        }

        .product-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #3a2c23;
            margin-bottom: 0.8rem;
            line-height: 1.1;
        }

        .price-section {
            margin-bottom: 2rem;
            display: flex;
            align-items: baseline;
            gap: 15px;
        }

        .current-price {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-color);
        }

        .old-price {
            font-size: 1.2rem;
            text-decoration: line-through;
            color: #b6a088;
        }

        .stock-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .in-stock {
            background: #e6f4ea;
            color: #1e7e34;
        }

        .out-of-stock {
            background: #fce8e8;
            color: #d93025;
        }

        .qty-label {
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .qty-selector {
            display: flex;
            align-items: center;
            background: #f8f1ea;
            border-radius: 12px;
            padding: 4px;
            width: fit-content;
            margin-bottom: 2.5rem;
        }

        .qty-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: none;
            background: white;
            color: var(--text-main);
            font-weight: 700;
            transition: var(--transition);
        }

        .qty-btn:hover {
            background: var(--accent-color);
            color: white;
        }

        .qty-input {
            width: 60px;
            border: none;
            background: transparent;
            text-align: center;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .btn-add-cart {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 1.2rem 2.5rem;
            border-radius: 16px;
            font-weight: 800;
            font-size: 1.1rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
        }

        .btn-add-cart:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(224, 90, 126, 0.3);
            color: white;
        }

        .btn-add-cart:disabled {
            background: #e0e0e0;
            transform: none;
            box-shadow: none;
        }

        .btn-wishlist {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            border: 2px solid #f0e6db;
            background: white;
            color: #d63031;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .btn-wishlist:hover {
            background: #fff5f5;
            border-color: #ffcccc;
        }

        .description-section {
            margin-top: 2rem;
            border-top: 1px solid #f3e9e2;
            padding-top: 2.5rem;
        }

        .description-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #3a2c23;
            position: relative;
            display: inline-block;
        }

        .description-title::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 2px;
        }

        .description-content {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.8;
            max-width: 900px;
        }

        .product-description-full {
            background: #fffdfb;
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
            animation: fadeUp 0.8s cubic-bezier(0.2, 0, 0, 1) forwards;
        }

        @media (max-width: 992px) {
            .product-info-container {
                padding: 2rem;
            }

            .product-title {
                font-size: 2.2rem;
            }
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
                    <a href="index.php?router=customers" class="logo">
                        <i class="bi bi-flower2"></i> FlowerTown
                    </a>
                </div>
                <div class="col-6">
                    <div class="header-icons d-flex justify-content-end align-items-center">
                        <a href="#"><i class="bi bi-heart"></i></a>
                        <a href="index.php?router=customers&controller=order&action=listOrders" title="Đơn hàng của tôi"><i class="bi bi-receipt"></i></a>
                        <?php
                        $cartCount = 0;
                        if (isset($_SESSION['customer'])) {
                            require_once __DIR__ . '/../../models/cart_model.php';
                            $cartModel = new CartModel();
                            $cartCount = $cartModel->getCartCount($_SESSION['customer']['customer_id']);
                        }
                        ?>
                        <a href="index.php?router=customers&controller=cart&action=listCart">
                            <i class="bi bi-bag"></i>
                            <span class="cart-badge"><?= $cartCount ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container py-5">
        <div class="product-detail-card animate-fade-up">
            <div class="row g-0">
                <div class="col-lg-6">
                    <div class="product-image-container">
                        <img src="uploads/<?= htmlspecialchars($product['image_url']) ?>"
                            alt="<?= htmlspecialchars($product['product_name']) ?>"
                            onerror="this.src='https://placehold.co/800x1000?text=Premium+Flower'">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-info-container">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb list-unstyled d-flex gap-2">
                                <li><a href="index.php?router=customers">Cửa hàng</a></li>
                                <li class="text-muted">/</li>
                                <li class="text-muted"><?= htmlspecialchars($category['category_name']) ?></li>
                            </ol>
                        </nav>

                        <h1 class="product-title heading-font"><?= htmlspecialchars($product['product_name']) ?></h1>

                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <span class="text-muted small fw-bold">(4.8/5 từ 120 đánh giá)</span>
                        </div>

                        <div class="price-section">
                            <?php if (isset($product['discounted_price'])): ?>
                                <span
                                    class="current-price"><?= number_format($product['discounted_price'], 0, ',', '.') ?>đ</span>
                                <span class="old-price"><?= number_format($product['price'], 0, ',', '.') ?>đ</span>
                            <?php else: ?>
                                <span
                                    class="current-price"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</span>
                            <?php endif; ?>
                        </div>

                        <div class="mb-4">
                            <?php if ($product['stock_quantity'] > 0): ?>
                                <div class="stock-status in-stock">
                                    <i class="bi bi-check-circle-fill"></i> Còn hàng (<?= $product['stock_quantity'] ?> sản
                                    phẩm)
                                </div>
                            <?php else: ?>
                                <div class="stock-status out-of-stock">
                                    <i class="bi bi-x-circle-fill"></i> Tạm hết hàng
                                </div>
                            <?php endif; ?>
                        </div>

                        <form action="index.php?router=customers&controller=cart&action=addCart" method="POST">
                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">

                            <div class="qty-label">Số lượng</div>
                            <div class="qty-selector">
                                <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                                <input type="number" id="quantity" name="quantity" class="qty-input" value="1" min="1"
                                    max="<?= $product['stock_quantity'] ?>">
                                <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                            </div>

                            <div class="d-flex gap-3">
                                <button type="submit" class="btn-add-cart"
                                    <?= $product['stock_quantity'] <= 0 ? 'disabled' : '' ?>>
                                    <i class="bi bi-bag-plus-fill"></i> THÊM VÀO GIỎ HÀNG
                                </button>
                                <button type="button" class="btn-wishlist">
                                    <i class="bi bi-heart-fill"></i>
                                </button>
                            </div>
                        </form>

                        <div class="mt-5 d-flex flex-wrap gap-4 pt-4 border-top">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-truck text-success fs-4"></i>
                                <span class="small fw-bold text-muted">Giao hàng 2h</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-shield-check text-success fs-4"></i>
                                <span class="small fw-bold text-muted">Hoa tươi 100%</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-arrow-counterclockwise text-success fs-4"></i>
                                <span class="small fw-bold text-muted">Đổi trả dễ dàng</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Full-width Description Section -->
            <div class="product-description-full px-4 px-md-5 pb-5">
                <div class="description-section pt-5">
                    <h3 class="description-title heading-font">Mô tả sản phẩm</h3>
                    <div class="description-content">
                        <?= nl2br(htmlspecialchars($product['description'])) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-5 mt-5 bg-white border-top">
        <div class="container text-center">
            <div class="logo justify-content-center mb-3">
                <i class="bi bi-flower2"></i> FlowerTown
            </div>
            <p class="text-muted small">© 2024 FlowerTown. Kiến tạo không gian từ những đóa hoa.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function changeQty(n) {
            let input = document.getElementById('quantity');
            let value = parseInt(input.value) + n;
            let min = parseInt(input.min) || 1;
            let max = parseInt(input.max);
            if (value < min) value = min;
            if (max && value > max) value = max;
            input.value = value;
        }
    </script>
</body>

</html>
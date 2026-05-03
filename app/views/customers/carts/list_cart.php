<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<?php
/**
 * @var array $listCart
 */
?>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Giỏ hàng của bạn - FlowerTown</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #e05a7e;
            --primary-gradient: linear-gradient(135deg, #e05a7e, #c4456c);
            --secondary-color: #9b6b43;
            --accent-color: #c7a17a;
            --bg-color: #fffafb;
            --card-bg: #ffffff;
            --text-main: #2d2a24;
            --text-muted: #6b5a4c;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --radius-lg: 24px;
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
            border-bottom: 1px solid rgba(0,0,0,0.05);
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

        /* Cart Content */
        .cart-container {
            margin-top: 3rem;
        }

        .cart-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0,0,0,0.02);
        }

        .cart-item {
            border-bottom: 1px solid #f3e9e2;
            padding: 1.5rem 0;
            transition: var(--transition);
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
        }

        .product-name {
            font-weight: 700;
            font-size: 1.1rem;
            color: #3a2c23;
            text-decoration: none;
            transition: var(--transition);
        }

        .product-name:hover {
            color: var(--primary-color);
        }

        .qty-control {
            display: flex;
            align-items: center;
            background: #f8f1ea;
            border-radius: 12px;
            padding: 2px;
            width: fit-content;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            border: none;
            background: white;
            color: var(--text-main);
            font-weight: 700;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover {
            background: var(--accent-color);
            color: white;
        }

        .qty-input {
            width: 45px;
            border: none;
            background: transparent;
            text-align: center;
            font-weight: 700;
        }

        .price-text {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .old-price {
            font-size: 0.85rem;
            text-decoration: line-through;
            color: #b6a088;
            display: block;
        }

        .btn-remove {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: #fff0f0;
            color: #d63031;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .btn-remove:hover {
            background: #d63031;
            color: white;
            transform: scale(1.1);
        }

        .summary-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(0,0,0,0.02);
            position: sticky;
            top: 110px;
        }

        .summary-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #3a2c23;
            border-bottom: 1px solid #f3e9e2;
            padding-bottom: 1rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-weight: 500;
            color: var(--text-muted);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f3e9e2;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .btn-checkout {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 16px;
            font-weight: 800;
            font-size: 1.1rem;
            transition: var(--transition);
            width: 100%;
            margin-top: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-checkout:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(224, 90, 126, 0.25);
            color: white;
        }

        .btn-continue {
            background: transparent;
            color: var(--accent-color);
            border: 2px solid #f0e6db;
            padding: 0.8rem;
            border-radius: 16px;
            font-weight: 700;
            width: 100%;
            margin-top: 1rem;
            transition: var(--transition);
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-continue:hover {
            background: #fdf8f4;
            border-color: var(--accent-color);
            color: var(--accent-color);
        }

        /* Animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-up {
            animation: fadeUp 0.6s cubic-bezier(0.2, 0, 0, 1) forwards;
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
            </div>
        </div>
    </header>

    <div class="container cart-container mb-5">
        <h1 class="heading-font fw-bold mb-4 animate-fade-up">Giỏ hàng của bạn</h1>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4 animate-fade-up" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4 animate-fade-up" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-lg-8 animate-fade-up">
                <div class="cart-card">
                    <?php if (empty($listCart)): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-bag-x display-1 text-muted opacity-25"></i>
                            <h3 class="mt-4 fw-bold">Giỏ hàng trống</h3>
                            <p class="text-muted">Bạn chưa chọn được đóa hoa nào ưng ý sao?</p>
                            <a href="index.php?router=customers" class="btn btn-primary rounded-pill px-5 py-3 mt-3" style="background: var(--primary-color); border: none;">MUA SẮM NGAY</a>
                        </div>
                    <?php else: ?>
                        <?php $total = 0; ?>
                        <?php foreach ($listCart as $item): ?>
                            <?php
                            $unitPrice = isset($item['discounted_price']) ? $item['discounted_price'] : $item['price'];
                            $subtotal = $unitPrice * $item['quantity'];
                            $total += $subtotal;
                            $detailUrl = "index.php?router=customers&controller=detail&action=index&id=" . $item['product_id'];
                            ?>
                            <div class="cart-item">
                                <div class="row align-items-center g-3">
                                    <div class="col-auto">
                                        <a href="<?= $detailUrl ?>">
                                            <img src="uploads/<?= htmlspecialchars($item['image_url']) ?>" 
                                                 alt="<?= htmlspecialchars($item['product_name']) ?>" 
                                                 class="cart-img"
                                                 onerror="this.src='https://placehold.co/200x200?text=Flower'">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="<?= $detailUrl ?>" class="product-name d-block mb-1"><?= htmlspecialchars($item['product_name']) ?></a>
                                        <span class="text-muted small fw-medium">Tình trạng: <?= $item['stock_quantity'] > 0 ? 'Còn hàng' : 'Hết hàng' ?></span>
                                        
                                        <div class="d-flex align-items-center gap-4 mt-3">
                                            <form action="index.php?router=customers&controller=cart&action=updateCart" method="POST" class="m-0">
                                                <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                                <div class="qty-control">
                                                    <button type="button" class="qty-btn" onclick="this.nextElementSibling.stepDown(); this.form.submit();">−</button>
                                                    <input type="number" name="quantity" class="qty-input" value="<?= $item['quantity'] ?>" min="1" max="<?= $item['stock_quantity'] ?>" onchange="this.form.submit()">
                                                    <button type="button" class="qty-btn" onclick="this.previousElementSibling.stepUp(); this.form.submit();">+</button>
                                                </div>
                                            </form>
                                            
                                            <div class="price-text">
                                                <?php if (isset($item['discounted_price'])): ?>
                                                    <span class="old-price"><?= number_format($item['price'], 0, ',', '.') ?>đ</span>
                                                    <?= number_format($item['discounted_price'], 0, ',', '.') ?>đ
                                                <?php else: ?>
                                                    <?= number_format($item['price'], 0, ',', '.') ?>đ
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <div class="fw-bold mb-2"><?= number_format($subtotal, 0, ',', '.') ?>đ</div>
                                        <a href="index.php?router=customers&controller=cart&action=deleteCart&cart_id=<?= $item['cart_id'] ?>" 
                                           class="btn-remove ms-auto"
                                           onclick="return confirm('Xóa sản phẩm này khỏi giỏ hàng?')">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (!empty($listCart)): ?>
                <div class="col-lg-4 animate-fade-up" style="animation-delay: 100ms">
                    <div class="summary-card">
                        <h2 class="summary-title heading-font">Thanh toán</h2>
                        
                        <div class="summary-row">
                            <span>Tạm tính</span>
                            <span><?= number_format($total, 0, ',', '.') ?>đ</span>
                        </div>
                        <div class="summary-row">
                            <span>Phí vận chuyển</span>
                            <span class="text-success">Miễn phí</span>
                        </div>
                        
                        <div class="total-row">
                            <span>Tổng cộng</span>
                            <span style="color: var(--primary-color)"><?= number_format($total, 0, ',', '.') ?>đ</span>
                        </div>

                        <a href="index.php?router=customers&controller=checkout&action=index" class="btn btn-checkout">
                            TIẾN HÀNH THANH TOÁN <i class="bi bi-arrow-right"></i>
                        </a>

                        <a href="index.php?router=customers" class="btn btn-continue">
                            <i class="bi bi-arrow-left"></i> TIẾP TỤC MUA SẮM
                        </a>
                        
                        <div class="mt-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="bi bi-shield-check text-success fs-4"></i>
                                <span class="small fw-bold text-muted">Thanh toán an toàn bảo mật</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-truck text-success fs-4"></i>
                                <span class="small fw-bold text-muted">Giao hàng nhanh trong 2h</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
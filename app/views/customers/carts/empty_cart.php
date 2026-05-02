<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giỏ hàng trống - Bloom & Co</title>

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
            max-width: 900px;
        }

        .empty-cart-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            padding: 4rem 2rem;
            text-align: center;
        }

        .empty-icon {
            font-size: 5rem;
            color: #f1cdd7;
            margin-bottom: 1.5rem;
        }

        .empty-title {
            color: #2d2a24;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .empty-subtitle {
            color: #6c757d;
            margin-bottom: 2.5rem;
        }

        .shop-now-btn {
            background: linear-gradient(135deg, #e05a7e, #c4456c);
            border: none;
            padding: 14px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            color: white;
            transition: all 0.2s;
            display: inline-block;
            text-decoration: none;
        }

        .shop-now-btn:hover {
            background: linear-gradient(135deg, #c4456c, #e05a7e);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 5px 15px rgba(224, 90, 126, 0.3);
        }
        /* Animations */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-up {
            opacity: 0;
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>

<body class="bg-light animate-fade-up">

    <!-- Header -->
    <header class="bg-white border-bottom sticky-top">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <a href="index.php?router=customers" class="text-decoration-none text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-flower1 fs-2 text-pink-400" style="color: #e05a7e;"></i>
                        <span class="heading-font fs-4 fw-bold">Bloom & Co</span>
                    </a>
                </div>
                <div class="col-md-5">
                    <form action="index.php" method="GET">
                        <input type="hidden" name="router" value="customers">
                        <input type="text" name="search" class="form-control rounded-pill" placeholder="Tìm kiếm hoa tươi...">
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="#" class="me-4 text-dark fs-4"><i class="bi bi-heart"></i></a>
                    <?php
                    $cartCount = 0;
                    if (isset($_SESSION['customer'])) {
                        include_once __DIR__ . '/../../../models/cart_model.php';
                        $cartModel = new CartModel();
                        $cartCount = $cartModel->getCartCount($_SESSION['customer']['customer_id']);
                    }
                    ?>
                    <a href="index.php?router=customers&controller=cart&action=listCart" class="me-4 text-dark fs-4 position-relative">
                        <i class="bi bi-cart" style="color: #e05a7e;"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill" style="font-size: 0.7rem;"><?= $cartCount ?></span>
                    </a>
                    <?php if (isset($_SESSION['customer'])): ?>
                        <span class="me-2 fw-medium">Xin chào, <?= htmlspecialchars($_SESSION['customer']['username']) ?></span>
                        <a href="index.php?router=logout" class="text-danger ms-2"><i class="bi bi-box-arrow-right"></i></a>
                    <?php else: ?>
                        <a href="index.php?router=login" class="text-dark ms-2"><i class="bi bi-person-circle fs-4"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div class="container main-container py-5">
        <div class="empty-cart-card">
            <i class="bi bi-cart-x empty-icon"></i>
            <h2 class="heading-font empty-title fs-2">Giỏ hàng của bạn đang trống</h2>
            <p class="empty-subtitle fs-5">Hãy thêm những bó hoa tươi thắm vào giỏ hàng nhé!</p>
            
            <a href="index.php?router=customers" class="shop-now-btn">
                <i class="bi bi-flower2 me-2"></i> Tiếp tục mua sắm
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

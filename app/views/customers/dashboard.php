<?php

/** @var array $products */
/** @var array $categories */
/** @var array $categoryCounts */
/** @var array $selectedCategories */
/** @var array|null $selectedPriceRange */
/** @var int $currentPage */
/** @var int $totalPages */
/** @var string $baseUrl */
/** @var int|float $minPrice */
/** @var int|float $maxPrice */

$currentPage = $currentPage ?? 1;
$totalPages  = $totalPages ?? 1;
$baseUrl     = $baseUrl ?? '?';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>FlowerTown - Cửa hàng hoa tươi cao cấp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fefaf5;
            color: #2d2a24;
            line-height: 1.5;
        }

        /* modern header - subtle glass */
        .header {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(0);
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.05), 0 2px 12px rgba(0, 0, 0, 0.02);
            padding: 0.9rem 0;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .logo {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -0.3px;
            background: linear-gradient(130deg, #2b5e3b, #9b6b43);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .logo i {
            background: none;
            background-clip: unset;
            color: #9b6b43;
            margin-right: 6px;
        }

        .search-box input {
            border-radius: 60px;
            border: 1px solid #f0e2d4;
            background: #ffffff;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
        }

        .search-box input:focus {
            border-color: #c7a17a;
            box-shadow: 0 0 0 3px rgba(199, 161, 122, 0.2);
            outline: none;
        }

        .header-icons a {
            color: #4a3b2c;
            margin-left: 1rem;
            font-size: 1.3rem;
            transition: color 0.2s;
            position: relative;
            text-decoration: none;
        }

        .header-icons a:hover {
            color: #c7a17a;
        }

        .cart-badge {
            background: #c7a17a;
            color: white;
            border-radius: 30px;
            padding: 0.2rem 0.5rem;
            font-size: 0.7rem;
            margin-left: -0.5rem;
            font-weight: 500;
        }

        /* hero banner - soft minimal */
        .hero {
            background: #f6ede5;
            padding: 3.5rem 0;
            margin-bottom: 2.5rem;
            border-radius: 0 0 48px 48px;
        }

        .hero h1 {
            font-size: 2.8rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #3a2c23;
        }

        .hero p {
            font-size: 1.1rem;
            color: #6b5a4c;
        }

        /* sidebar filter card */
        .filter-card {
            background: #ffffff;
            border-radius: 28px;
            padding: 1.6rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.03);
            border: 1px solid #f5ede5;
            position: sticky;
            top: 100px;
        }

        .filter-title {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #2b5e3b;
        }

        .filter-group h6 {
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
            margin-bottom: 1rem;
            color: #3a2c23;
        }

        .filter-item {
            margin-bottom: 0.7rem;
        }

        .filter-item label {
            cursor: pointer;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            color: #4e4136;
            transition: color 0.2s;
        }

        .filter-item label:hover {
            color: #c7a17a;
        }

        .filter-item input {
            margin-right: 10px;
            accent-color: #c7a17a;
            transform: scale(1.05);
        }

        .category-badge {
            background: #f7f1eb;
            border-radius: 40px;
            padding: 2px 10px;
            font-size: 0.75rem;
            font-weight: 500;
            color: #8b765c;
        }

        hr {
            opacity: 0.4;
            margin: 1rem 0;
        }

        /* product grid */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
            margin-bottom: 1.8rem;
        }

        .section-header h2 {
            font-weight: 700;
            font-size: 1.8rem;
            color: #2d2a24;
            letter-spacing: -0.3px;
        }

        .result-count {
            font-size: 0.85rem;
            color: #9b8a7a;
            background: #f3ede8;
            padding: 0.3rem 0.9rem;
            border-radius: 60px;
        }

        .product-card {
            background: #ffffff;
            border-radius: 28px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid #f3e9e2;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.02);
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 22px 35px -12px rgba(0, 0, 0, 0.1);
            border-color: #e9dbd0;
        }

        .product-img {
            position: relative;
            height: 230px;
            background: #faf5f0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-img img {
            transform: scale(1.03);
        }

        .product-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(255, 255, 240, 0.9);
            backdrop-filter: blur(4px);
            color: #2b5e3b;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 40px;
            letter-spacing: 0.3px;
        }

        .product-body {
            padding: 1.2rem 1.2rem 1.4rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .product-name {
            font-weight: 700;
            font-size: 1.05rem;
            color: #2d2a24;
            margin-bottom: 0.25rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-category {
            font-size: 0.75rem;
            color: #b6a088;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .product-price {
            margin-top: 0.4rem;
            margin-bottom: 0.8rem;
        }

        .current-price {
            font-size: 1.45rem;
            font-weight: 700;
            color: #3a6b47;
        }

        .old-price {
            font-size: 0.85rem;
            text-decoration: line-through;
            color: #b6a088;
            margin-left: 0.5rem;
        }

        .discount-badge {
            background: #fae6e0;
            color: #b45a3b;
            font-size: 0.7rem;
            font-weight: 700;
            margin-left: 8px;
            padding: 2px 8px;
            border-radius: 40px;
        }

        .product-stock {
            font-size: 0.75rem;
            margin: 0.5rem 0 0.9rem;
        }

        .stock-available {
            color: #5b8c5a;
            font-weight: 500;
        }

        .product-actions {
            display: flex;
            gap: 8px;
            margin-top: auto;
        }

        .btn-add-cart {
            flex: 1;
            background: #3954dbff;
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.7rem 0;
            border-radius: 40px;
            font-size: 0.85rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-add-cart:hover {
            background: #da3207ff;
            transform: scale(0.98);
        }

        .btn-add-cart:disabled {
            background: #cdc2b6;
            cursor: not-allowed;
        }

        .btn-wishlist {
            background: #fff1e8;
            border: none;
            width: 44px;
            border-radius: 40px;
            color: #b45a3b;
            transition: all 0.2s;
        }

        .btn-wishlist:hover {
            background: #ffded0;
            color: #a13e1c;
        }

        /* pagination modern */
        .pagination-modern {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 3rem;
            margin-bottom: 2rem;
        }

        .pagination-modern .page-link-custom {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            height: 42px;
            border-radius: 30px;
            background: white;
            color: #4e4136;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid #efe2d8;
        }

        .pagination-modern .page-link-custom:hover {
            background: #f5ede5;
            border-color: #dccbbc;
            color: #2b5e3b;
        }

        .pagination-modern .active .page-link-custom {
            background: #2b5e3b;
            border-color: #2b5e3b;
            color: white;
        }

        .pagination-modern .disabled .page-link-custom {
            opacity: 0.5;
            pointer-events: none;
        }

        /* empty state */
        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            background: #fefaf7;
            border-radius: 48px;
        }

        .empty-state i {
            font-size: 3.5rem;
            color: #dccbbc;
        }

        /* footer minimal */
        .footer {
            background: #f8f2ec;
            padding: 2.5rem 0 1.5rem;
            margin-top: 4rem;
            border-top: 1px solid #eedfcb;
        }

        .footer a {
            color: #7b6a5a;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .footer a:hover {
            color: #2b5e3b;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .section-header h2 {
                font-size: 1.5rem;
            }

            .filter-card {
                margin-bottom: 20px;
            }
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

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-fade-up {
            opacity: 0;
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animate-fade-in {
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }

        /* Staggered animation delays */
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        .delay-400 { animation-delay: 400ms; }
        .delay-500 { animation-delay: 500ms; }
    </style>
</head>

<body>

    <!-- header -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-md-3 col-6">
                    <div class="logo"><i class="bi bi-flower2"></i> FlowerTown</div>
                </div>
                <div class="col-md-5 col-12 order-md-0 order-3">
                    <div class="search-box">
                        <input type="text" class="form-control" placeholder="Tìm kiếm hoa, bó hoa, quà tặng...">
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="header-icons d-flex justify-content-end align-items-center">
                        <a href="#" class="d-none d-md-block"><i class="bi bi-heart"></i></a>
                        <?php
                        $cartCount = 0;
                        if (isset($_SESSION['customer'])) {
                            include_once __DIR__ . '/../../models/cart_model.php';
                            $cartModel = new CartModel();
                            $cartCount = $cartModel->getCartCount($_SESSION['customer']['customer_id']);
                        }
                        ?>
                        <a href="index.php?router=customers&controller=cart&action=listCart">
                            <i class="bi bi-cart"></i>
                            <span class="cart-badge"><?= $cartCount ?></span>
                        </a>
                        <?php if (isset($_SESSION['customer'])): ?>
                            <span class="text-dark me-2 d-none d-md-inline"><?php echo htmlspecialchars($_SESSION['customer']['username']); ?></span>
                            <a href="../../../index.php?router=logout"><i class="bi bi-box-arrow-right"></i></a>
                        <?php else: ?>
                            <a href="?router=login"><i class="bi bi-person-circle"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- hero banner -->
    <section class="hero animate-fade-in">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h1>Hoa tươi từ vườn,<br>gửi yêu thương đến bạn</h1>
                    <p class="mt-3">Những bó hoa đẹp nhất, thiết kế tinh tế và giao hàng nhanh chóng trong ngày.</p>
                </div>
                <div class="col-md-5 text-end d-none d-md-block">
                    <i class="bi bi-flower1" style="font-size: 6rem; color: #e8cfb0;"></i>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row g-4">
            <!-- filter sidebar -->
            <div class="col-lg-3">
                <div class="filter-card animate-fade-up delay-100">
                    <div class="filter-title d-flex justify-content-between align-items-center w-100">
                        <div>
                            <i class="bi bi-sliders2"></i> Bộ lọc
                        </div>
                        <?php if (!empty($selectedCategories) || !empty($_GET['price_range'])): ?>
                            <a href="index.php?router=customers" class="text-danger text-decoration-none" style="font-size: 0.85rem; font-weight: 500;">
                                <i class="bi bi-arrow-clockwise"></i> Đặt lại
                            </a>
                        <?php endif; ?>
                    </div>
                    <form id="filterForm" method="GET" action="index.php">
                        <input type="hidden" name="router" value="customers">
                        <input type="hidden" name="controller" value="index">
                        <input type="hidden" name="action" value="index">

                        <div class="filter-group">
                            <h6>Danh mục</h6>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <div class="filter-item">
                                        <label>
                                            <span>
                                                <input type="checkbox" name="categories[]" value="<?php echo $category['category_id']; ?>" <?php echo in_array($category['category_id'], $selectedCategories) ? 'checked' : ''; ?>>
                                                <?php echo htmlspecialchars($category['category_name']); ?>
                                            </span>
                                            <span class="category-badge"><?php echo $categoryCounts[$category['category_id']] ?? 0; ?></span>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <hr>

                        <div class="filter-group">
                            <h6>Khoảng giá</h6>
                            <div class="filter-item"><label><input type="radio" name="price_range" value="" <?php echo empty($_GET['price_range']) ? 'checked' : ''; ?>> Tất cả</label></div>
                            <div class="filter-item"><label><input type="radio" name="price_range" value="0-50000" <?php echo $selectedPriceRange && $selectedPriceRange[0] == 0 && $selectedPriceRange[1] == 50000 ? 'checked' : ''; ?>> Dưới 50.000đ</label></div>
                            <div class="filter-item"><label><input type="radio" name="price_range" value="50000-100000" <?php echo $selectedPriceRange && $selectedPriceRange[0] == 50000 && $selectedPriceRange[1] == 100000 ? 'checked' : ''; ?>> 50.000 - 100.000đ</label></div>
                            <div class="filter-item"><label><input type="radio" name="price_range" value="100000-200000" <?php echo $selectedPriceRange && $selectedPriceRange[0] == 100000 && $selectedPriceRange[1] == 200000 ? 'checked' : ''; ?>> 100.000 - 200.000đ</label></div>
                            <div class="filter-item"><label><input type="radio" name="price_range" value="200000-999999999" <?php echo $selectedPriceRange && $selectedPriceRange[0] == 200000 ? 'checked' : ''; ?>> Trên 200.000đ</label></div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- product listing -->
            <div class="col-lg-9">
                <div class="section-header animate-fade-up delay-200">
                    <h2>🌸 Hoa tươi nổi bật</h2>
                    <div class="result-count"><?php echo count($products); ?> sản phẩm</div>
                </div>

                <div class="row g-4">
                    <?php if (!empty($products)): ?>
                        <?php $delayCounter = 1; ?>
                        <?php foreach ($products as $product): ?>
                            <?php 
                                $detailUrl = 'index.php?router=customers&controller=detail&action=index&id=' . $product['product_id']; 
                                $delayClass = 'delay-' . min(500, $delayCounter * 100);
                                $delayCounter++;
                            ?>
                            <div class="col-md-6 col-xl-4 animate-fade-up <?= $delayClass ?>">
                                <div class="product-card">
                                    <div class="product-img">
                                        <a href="<?php echo $detailUrl; ?>">
                                            <img src="uploads/<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" onerror="this.src='https://placehold.co/400x300?text=Flower+Image'">
                                        </a>
                                        <?php if ($product['stock_quantity'] > 0): ?>
                                            <div class="product-badge">Còn hàng</div>
                                        <?php else: ?>
                                            <div class="product-badge" style="background:#e3cfc0; color:#885e46;">Hết hàng</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-body">
                                        <a href="<?php echo $detailUrl; ?>" class="text-decoration-none">
                                            <div class="product-name"><?php echo htmlspecialchars($product['product_name']); ?></div>
                                        </a>
                                        <div class="product-category"><?php echo htmlspecialchars($product['category_name']); ?></div>
                                        <div class="product-price">
                                            <?php if (isset($product['discounted_price'])): ?>
                                                <span class="current-price"><?php echo number_format($product['discounted_price'], 0, ',', '.'); ?>đ</span>
                                                <span class="old-price"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</span>
                                                <span class="discount-badge">
                                                    <?php echo $product['promotion']['discount_type'] === 'percentage' ? '-' . $product['promotion']['discount_value'] . '%' : '-' . number_format($product['promotion']['discount_value'], 0, ',', '.') . 'đ'; ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="current-price"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="product-stock">
                                            <?php if ($product['stock_quantity'] > 0): ?>
                                                <span class="stock-available"><i class="bi bi-check-circle-fill"></i> Còn <?php echo $product['stock_quantity']; ?> sp</span>
                                            <?php else: ?>
                                                <span class="stock-unavailable" style="color:#c08267;">Tạm hết</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="product-actions">
                                            <form action="index.php?router=customers&controller=cart&action=addCart" method="POST" class="flex-grow-1 m-0">
                                                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn-add-cart w-100" <?php echo $product['stock_quantity'] > 0 ? '' : 'disabled'; ?>>
                                                    <i class="bi bi-bag-plus"></i> Thêm giỏ
                                                </button>
                                            </form>
                                            <button class="btn-wishlist"><i class="bi bi-heart"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="bi bi-flower2"></i>
                                <h5 class="mt-3">Chưa có sản phẩm nào</h5>
                                <p>Hãy thử chọn bộ lọc khác nhé</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- pagination -->
                <?php if ($totalPages > 1):
                    $queryParams = $_GET;
                    unset($queryParams['page']);
                    $baseQuery = http_build_query($queryParams);
                    $baseUrl = 'index.php' . ($baseQuery ? '?' . $baseQuery . '&' : '?');
                    $start = max(1, $currentPage - 2);
                    $end = min($totalPages, $currentPage + 2);
                    if ($currentPage <= 3) {
                        $start = 1;
                        $end = min($totalPages, 5);
                    }
                    if ($currentPage >= $totalPages - 2) {
                        $end = $totalPages;
                        $start = max(1, $totalPages - 4);
                    }
                ?>
                    <div class="pagination-modern">
                        <div class="<?= $currentPage <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link-custom" href="<?= $currentPage > 1 ? $baseUrl . 'page=' . ($currentPage - 1) : '#' ?>"><i class="bi bi-chevron-left"></i></a>
                        </div>
                        <?php if ($start > 1): ?>
                            <div class="disabled"><span class="page-link-custom">...</span></div>
                        <?php endif; ?>
                        <?php for ($i = $start; $i <= $end; $i++): ?>
                            <div class="<?= $i == $currentPage ? 'active' : '' ?>">
                                <a class="page-link-custom" href="<?= $baseUrl ?>page=<?= $i ?>"><?= $i ?></a>
                            </div>
                        <?php endfor; ?>
                        <?php if ($end < $totalPages): ?>
                            <div class="disabled"><span class="page-link-custom">...</span></div>
                        <?php endif; ?>
                        <div class="<?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link-custom" href="<?= $currentPage < $totalPages ? $baseUrl . 'page=' . ($currentPage + 1) : '#' ?>"><i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-3">
                    <div class="logo mb-2" style="font-size: 1.3rem"><i class="bi bi-flower2"></i> FlowerTown</div>
                    <p class="text-muted small">Mang hơi thở thiên nhiên vào không gian sống của bạn.</p>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-semibold">Hỗ trợ</h6>
                    <div class="d-flex flex-column gap-2 mt-2">
                        <a href="#"><i class="bi bi-question-circle me-1"></i> FAQ</a>
                        <a href="#"><i class="bi bi-headset"></i> Liên hệ</a>
                        <a href="#">Chính sách đổi trả</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-semibold">Về chúng tôi</h6>
                    <div class="d-flex flex-column gap-2 mt-2">
                        <a href="#">Câu chuyện thương hiệu</a>
                        <a href="#">Hệ thống cửa hàng</a>
                        <a href="#">Tuyển dụng</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-semibold">Kết nối</h6>
                    <div class="d-flex gap-3 mt-2">
                        <a href="#"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#"><i class="bi bi-pinterest fs-5"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-4 opacity-25">
            <div class="text-center small text-muted">© 2025 FlowerTown - Yêu thương gửi qua từng cánh hoa</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('filterForm');
            const checkboxes = document.querySelectorAll('.filter-item input[type="checkbox"]');
            const radios = document.querySelectorAll('.filter-item input[type="radio"]');
            const submit = () => {
                const pageInput = form.querySelector('input[name="page"]');
                if (pageInput) pageInput.remove();
                form.submit();
            };
            checkboxes.forEach(cb => cb.addEventListener('change', submit));
            radios.forEach(rb => rb.addEventListener('change', submit));
        });
    </script>
</body>
</html>
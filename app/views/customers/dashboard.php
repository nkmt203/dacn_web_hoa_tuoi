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
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap"
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
        --radius-lg: 24px;
        --radius-md: 16px;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.06);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-color);
        color: var(--text-main);
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
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
        transition: var(--transition);
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
    }

    .logo i {
        -webkit-text-fill-color: var(--secondary-color);
        font-size: 1.8rem;
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        border-radius: 50px;
        border: 1px solid #e9e0d6;
        background: #fff;
        padding: 0.7rem 1.5rem 0.7rem 3rem;
        font-size: 0.9rem;
        transition: var(--transition);
        width: 100%;
    }

    .search-box i {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--accent-color);
        font-size: 1.1rem;
    }

    .search-box input:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 4px rgba(199, 161, 122, 0.15);
        outline: none;
    }

    .header-icons {
        gap: 1.2rem;
    }

    .header-icons a {
        color: var(--text-main);
        font-size: 1.4rem;
        transition: var(--transition);
        position: relative;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .header-icons a:hover {
        color: var(--accent-color);
        transform: translateY(-2px);
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

    .user-greeting {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        margin-right: 0.5rem;
    }

    /* Premium Hero Section */
    .hero {
        background: linear-gradient(135deg, #f6ede5 0%, #ede0d4 100%);
        padding: 2.5rem 0;
        margin-bottom: 2.5rem;
        border-radius: 0 0 40px 40px;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 70%);
        border-radius: 50%;
    }

    .hero h1 {
        font-size: 2.5rem;
        font-weight: 800;
        letter-spacing: -1px;
        color: #3a2c23;
        line-height: 1.1;
    }

    .hero p {
        font-size: 1.2rem;
        color: var(--text-muted);
        max-width: 500px;
    }

    /* Sidebar Filter */
    .filter-card {
        background: var(--card-bg);
        border-radius: var(--radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid #f0e6db;
        position: sticky;
        top: 110px;
    }

    .filter-title {
        font-weight: 800;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        color: var(--primary-color);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-group h6 {
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 1.2rem;
        color: var(--text-main);
    }

    .filter-item {
        margin-bottom: 0.8rem;
    }

    .filter-item label {
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.95rem;
        color: var(--text-muted);
        transition: var(--transition);
        padding: 4px 0;
    }

    .filter-item label:hover {
        color: var(--primary-color);
    }

    .filter-item input {
        accent-color: var(--primary-color);
        width: 18px;
        height: 18px;
        border-radius: 4px;
        margin-right: 12px;
    }

    .category-badge {
        background: #f8f1ea;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--secondary-color);
    }

    /* Product Grid */
    .section-header {
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .section-header h2 {
        font-weight: 800;
        font-size: 2rem;
        color: var(--text-main);
        letter-spacing: -0.5px;
    }

    .result-count {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--secondary-color);
        background: #f3ede8;
        padding: 0.4rem 1rem;
        border-radius: 50px;
    }

    .product-card {
        background: var(--card-bg);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #f3e9e2;
        box-shadow: var(--shadow-sm);
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        border-color: var(--accent-color);
    }

    .product-img {
        position: relative;
        height: 260px;
        background: #faf5f0;
        overflow: hidden;
    }

    .product-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .product-card:hover .product-img img {
        transform: scale(1.05);
    }

    .product-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        padding: 5px 14px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--primary-color);
        box-shadow: var(--shadow-sm);
        z-index: 2;
    }

    .product-body {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-category {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--accent-color);
        margin-bottom: 0.5rem;
    }

    .product-name {
        font-weight: 700;
        font-size: 1.15rem;
        color: var(--text-main);
        margin-bottom: 0.8rem;
        line-height: 1.3;
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-price {
        display: flex;
        align-items: baseline;
        gap: 8px;
        margin-bottom: 1rem;
    }

    .current-price {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--primary-color);
    }

    .old-price {
        font-size: 0.9rem;
        text-decoration: line-through;
        color: #b6a088;
    }

    .discount-pill {
        background: #fff0f0;
        color: #d63031;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 4px;
    }

    .product-footer {
        margin-top: auto;
        display: flex;
        gap: 10px;
    }

    .btn-add-cart {
        flex: 1;
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 0.8rem;
        border-radius: 14px;
        font-weight: 700;
        font-size: 0.85rem;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-add-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(224, 90, 126, 0.25);
        color: white;
    }

    .btn-add-cart:disabled {
        background: #e0e0e0;
        color: #999;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .btn-wishlist {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        border: 1.5px solid #f0e6db;
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
        transform: translateY(-2px);
    }

    /* Modern Pagination */
    .pagination-container {
        margin-top: 4rem;
        display: flex;
        justify-content: center;
    }

    .pagination-modern {
        display: flex;
        gap: 10px;
    }

    .page-item-custom {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: white;
        border: 1px solid #f0e6db;
        color: var(--text-main);
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }

    .page-item-custom:hover {
        background: var(--bg-color);
        border-color: var(--accent-color);
        color: var(--accent-color);
    }

    .page-item-custom.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .page-item-custom.disabled {
        opacity: 0.4;
        pointer-events: none;
    }

    /* Footer */
    .footer {
        background: #2d2a24;
        color: #f6ede5;
        padding: 5rem 0 2rem;
        margin-top: 6rem;
    }

    .footer a {
        color: #b6a088;
        text-decoration: none;
        transition: var(--transition);
    }

    .footer a:hover {
        color: white;
    }

    .footer-logo {
        font-size: 1.8rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1.5rem;
    }

    /* Animations */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-up {
        animation: fadeUp 0.6s cubic-bezier(0.2, 0, 0, 1) forwards;
    }

    @media (max-width: 768px) {
        .hero h1 { font-size: 2.2rem; }
        .hero { border-radius: 0 0 40px 40px; padding: 3rem 0; }
        .section-header h2 { font-size: 1.5rem; }
        .header { padding: 0.6rem 0; }
    }
    </style>
</head>

<body>

    <!-- header -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-md-3 col-6">
                    <a href="index.php?router=customers" class="text-decoration-none">
                        <div class="logo"><i class="bi bi-flower2"></i> FlowerTown</div>
                    </a>
                </div>
                <div class="col-md-5 col-12 order-md-0 order-3">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" class="form-control" placeholder="Tìm kiếm hoa tươi, quà tặng...">
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="header-icons d-flex justify-content-end align-items-center">
                        <a href="#" class="d-none d-md-flex"><i class="bi bi-heart"></i></a>
                        <a href="index.php?router=customers&controller=order&action=listOrders" title="Đơn hàng của tôi"><i class="bi bi-receipt"></i></a>
                        <?php
                        $cartCount = 0;
                        if (isset($_SESSION['customer'])) {
                            include_once __DIR__ . '/../../models/cart_model.php';
                            $cartModel = new CartModel();
                            $cartCount = $cartModel->getCartCount($_SESSION['customer']['customer_id']);
                        }
                        ?>
                        <a href="index.php?router=customers&controller=cart&action=listCart">
                            <i class="bi bi-bag"></i>
                            <span class="cart-badge"><?= $cartCount ?></span>
                        </a>
                        <?php if (isset($_SESSION['customer'])): ?>
                        <div class="d-flex align-items-center gap-2">
                            <span class="user-greeting d-none d-md-inline">Hi, <?= htmlspecialchars($_SESSION['customer']['full_name']); ?></span>
                            <a href="index.php?router=logout" title="Đăng xuất"><i class="bi bi-box-arrow-right"></i></a>
                        </div>
                        <?php else: ?>
                        <a href="index.php?router=login" title="Đăng nhập"><i class="bi bi-person"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- hero banner -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7 animate-fade-up">
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm">NEW COLLECTION 2024</span>
                    <h1>Trao gửi yêu thương qua từng cánh hoa</h1>
                    <p class="mt-3">Khám phá bộ sưu tập hoa tươi thiết kế cao cấp, giao hỏa tốc trong 2 giờ tại khu vực nội thành.</p>
                    <div class="mt-4">
                        <a href="#products" class="btn btn-primary px-5 py-3 rounded-pill fw-bold" style="background: var(--primary-color); border: none;">MUA NGAY</a>
                    </div>
                </div>
                <div class="col-md-5 text-end d-none d-md-block animate-fade-up" style="animation-delay: 200ms">
                    <img src="https://images.unsplash.com/photo-1526047932273-341f2a7631f9?q=80&w=1000&auto=format&fit=crop" class="img-fluid rounded-4 shadow-lg" alt="Flower Hero" style="max-height: 400px; width: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    <div class="container" id="products">
        <div class="row g-4">
            <!-- filter sidebar -->
            <div class="col-lg-3">
                <div class="filter-card animate-fade-up">
                    <div class="filter-title">
                        <i class="bi bi-sliders"></i> Bộ lọc
                    </div>
                    
                    <form id="filterForm" method="GET" action="index.php">
                        <input type="hidden" name="router" value="customers">
                        <input type="hidden" name="controller" value="index">
                        <input type="hidden" name="action" value="index">

                        <div class="filter-group">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="m-0">Danh mục</h6>
                                <?php if (!empty($selectedCategories) || !empty($_GET['price_range'])): ?>
                                <a href="index.php?router=customers" class="text-danger text-decoration-none small fw-bold">XÓA TẤT CẢ</a>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                            <div class="filter-item">
                                <label>
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" name="categories[]"
                                            value="<?php echo $category['category_id']; ?>"
                                            <?php echo in_array($category['category_id'], $selectedCategories) ? 'checked' : ''; ?>>
                                        <span><?php echo htmlspecialchars($category['category_name']); ?></span>
                                    </div>
                                    <span class="category-badge"><?php echo $categoryCounts[$category['category_id']] ?? 0; ?></span>
                                </label>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <hr class="my-4 opacity-10">

                        <div class="filter-group">
                            <h6>Khoảng giá</h6>
                            <div class="filter-item">
                                <label>
                                    <div class="d-flex align-items-center">
                                        <input type="radio" name="price_range" value="" <?php echo empty($_GET['price_range']) ? 'checked' : ''; ?>> 
                                        <span>Tất cả giá</span>
                                    </div>
                                </label>
                            </div>
                            <div class="filter-item">
                                <label>
                                    <div class="d-flex align-items-center">
                                        <input type="radio" name="price_range" value="0-50000" <?php echo isset($_GET['price_range']) && $_GET['price_range'] == '0-50000' ? 'checked' : ''; ?>> 
                                        <span>Dưới 50.000đ</span>
                                    </div>
                                </label>
                            </div>
                            <div class="filter-item">
                                <label>
                                    <div class="d-flex align-items-center">
                                        <input type="radio" name="price_range" value="50000-100000" <?php echo isset($_GET['price_range']) && $_GET['price_range'] == '50000-100000' ? 'checked' : ''; ?>> 
                                        <span>50.000 - 100.000đ</span>
                                    </div>
                                </label>
                            </div>
                            <div class="filter-item">
                                <label>
                                    <div class="d-flex align-items-center">
                                        <input type="radio" name="price_range" value="100000-200000" <?php echo isset($_GET['price_range']) && $_GET['price_range'] == '100000-200000' ? 'checked' : ''; ?>> 
                                        <span>100.000 - 200.000đ</span>
                                    </div>
                                </label>
                            </div>
                            <div class="filter-item">
                                <label>
                                    <div class="d-flex align-items-center">
                                        <input type="radio" name="price_range" value="200000-999999999" <?php echo isset($_GET['price_range']) && $_GET['price_range'] == '200000-999999999' ? 'checked' : ''; ?>> 
                                        <span>Trên 200.000đ</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- product listing -->
            <div class="col-lg-9">
                <div class="section-header">
                    <h2>Bộ sưu tập hoa</h2>
                    <div class="result-count"><?php echo count($products); ?> sản phẩm</div>
                </div>

                <div class="row g-4">
                    <?php if (!empty($products)): ?>
                    <?php $delay = 100; ?>
                    <?php foreach ($products as $product): ?>
                    <?php
                            $detailUrl = 'index.php?router=customers&controller=detail&action=index&id=' . $product['product_id'];
                            ?>
                    <div class="col-md-6 col-xl-4 animate-fade-up" style="animation-delay: <?= $delay ?>ms">
                        <div class="product-card">
                            <div class="product-img">
                                <a href="<?php echo $detailUrl; ?>">
                                    <img src="uploads/<?php echo htmlspecialchars($product['image_url']); ?>"
                                        alt="<?php echo htmlspecialchars($product['product_name']); ?>"
                                        onerror="this.src='https://placehold.co/400x500?text=Flower+Product'">
                                </a>
                                <?php if (isset($product['discounted_price'])): ?>
                                <div class="product-badge">SALE</div>
                                <?php endif; ?>
                            </div>
                            <div class="product-body">
                                <div class="product-category"><?php echo htmlspecialchars($product['category_name']); ?></div>
                                <a href="<?php echo $detailUrl; ?>" class="product-name"><?php echo htmlspecialchars($product['product_name']); ?></a>
                                
                                <div class="product-price">
                                    <?php if (isset($product['discounted_price'])): ?>
                                    <span class="current-price"><?php echo number_format($product['discounted_price'], 0, ',', '.'); ?>đ</span>
                                    <span class="old-price"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</span>
                                    <?php else: ?>
                                    <span class="current-price"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</span>
                                    <?php endif; ?>
                                </div>

                                <div class="product-footer">
                                    <form action="index.php?router=customers&controller=cart&action=addCart"
                                        method="POST" class="flex-grow-1">
                                        <input type="hidden" name="product_id"
                                            value="<?php echo $product['product_id']; ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn-add-cart w-100"
                                            <?php echo $product['stock_quantity'] > 0 ? '' : 'disabled'; ?>>
                                            <i class="bi bi-bag-plus"></i> <?php echo $product['stock_quantity'] > 0 ? 'Thêm vào giỏ' : 'Hết hàng'; ?>
                                        </button>
                                    </form>
                                    <button class="btn-wishlist"><i class="bi bi-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $delay += 50; if($delay > 500) $delay = 500; ?>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-flower2 display-1 text-muted opacity-25"></i>
                        <h4 class="mt-4 fw-bold">Không tìm thấy sản phẩm</h4>
                        <p class="text-muted">Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm nhé!</p>
                        <a href="index.php?router=customers" class="btn btn-outline-primary rounded-pill px-4 mt-2">Xem tất cả hoa</a>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- pagination -->
                <?php if ($totalPages > 1):
                    $queryParams = $_GET;
                    unset($queryParams['page']);
                    $baseQuery = http_build_query($queryParams);
                    $baseUrl = 'index.php' . ($baseQuery ? '?' . $baseQuery . '&' : '?');
                ?>
                <div class="pagination-container">
                    <div class="pagination-modern">
                        <a class="page-item-custom <?= $currentPage <= 1 ? 'disabled' : '' ?>"
                            href="<?= $currentPage > 1 ? $baseUrl . 'page=' . ($currentPage - 1) : '#' ?>">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        
                        <?php 
                        $startPage = max(1, $currentPage - 1);
                        $endPage = min($totalPages, $startPage + 2);
                        if($endPage - $startPage < 2) $startPage = max(1, $endPage - 2);
                        
                        for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <a class="page-item-custom <?= $i == $currentPage ? 'active' : '' ?>" href="<?= $baseUrl ?>page=<?= $i ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <a class="page-item-custom <?= $currentPage >= $totalPages ? 'disabled' : '' ?>"
                            href="<?= $currentPage < $totalPages ? $baseUrl . 'page=' . ($currentPage + 1) : '#' ?>">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-logo"><i class="bi bi-flower2"></i> FlowerTown</div>
                    <p class="opacity-75">Chúng tôi tin rằng mỗi đóa hoa đều mang một câu chuyện riêng. FlowerTown cam kết mang đến những thiết kế hoa tươi tinh tế nhất cho mọi khoảnh khắc đáng nhớ của bạn.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="fs-4"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="fs-4"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="fs-4"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h6 class="fw-bold mb-4">CỬA HÀNG</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="#">Tất cả sản phẩm</a></li>
                        <li><a href="#">Hoa cưới</a></li>
                        <li><a href="#">Hoa sinh nhật</a></li>
                        <li><a href="#">Hoa khai trương</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h6 class="fw-bold mb-4">HỖ TRỢ</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="#">Hướng dẫn mua hàng</a></li>
                        <li><a href="#">Chính sách giao hàng</a></li>
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-4">
                    <h6 class="fw-bold mb-4">ĐĂNG KÝ NHẬN TIN</h6>
                    <p class="small opacity-75">Đăng ký để nhận thông báo về các bộ sưu tập mới và ưu đãi độc quyền.</p>
                    <div class="input-group mt-3">
                        <input type="email" class="form-control bg-transparent border-secondary text-white" placeholder="Email của bạn" style="border-radius: 10px 0 0 10px">
                        <button class="btn btn-primary px-3" style="background: var(--accent-color); border: none; border-radius: 0 10px 10px 0">GỬI</button>
                    </div>
                </div>
            </div>
            <hr class="my-5 opacity-10">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <p class="small m-0 opacity-50">&copy; 2024 FlowerTown. All rights reserved.</p>
                <div class="d-flex gap-4 small opacity-50">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
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
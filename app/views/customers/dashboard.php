<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cửa Hàng Hoa Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .search-box {
            margin: 0 1rem;
        }

        .search-box input {
            border-radius: 25px;
            border: none;
            padding: 0.5rem 1rem;
        }

        .header-icons {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .header-icons a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            transition: transform 0.3s;
        }

        .header-icons a:hover {
            transform: scale(1.2);
        }

        .cart-badge {
            background-color: #e74c3c;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.75rem;
            margin-left: -0.5rem;
        }

        .banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            text-align: center;
            margin-bottom: 2rem;
        }

        .banner h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .banner p {
            font-size: 1.1rem;
        }

        .sidebar {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 20px;
            height: fit-content;
        }

        .sidebar h5 {
            margin-bottom: 1rem;
            font-weight: bold;
            color: #667eea;
        }

        .sidebar-item {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }

        .sidebar-item:last-child {
            border-bottom: none;
        }

        .products-section {
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: #333;
            font-weight: bold;
        }

        .products-section .row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .products-section .col-md-6.col-lg-4 {
            flex: 0 0 calc(33.333% - 1rem);
            max-width: calc(33.333% - 1rem);
            margin-bottom: 1rem;
        }

        @media (max-width: 992px) {
            .products-section .col-md-6.col-lg-4 {
                flex: 0 0 calc(50% - 1rem);
                max-width: calc(50% - 1rem);
            }
        }

        @media (max-width: 576px) {
            .products-section .col-md-6.col-lg-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .product-card {
            min-height: 450px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .product-img {
            height: 220px;
            object-fit: cover;
            background: #f0f0f0;
            position: relative;
            overflow: hidden;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-link {
            color: inherit;
            text-decoration: none;
        }

        .product-link:hover .product-name {
            color: #667eea;
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #e74c3c;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85rem;
        }

        .product-body {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .product-category {
            color: #999;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .product-price {
            color: #e74c3c;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.75rem;
        }

        .product-content {
            flex-grow: 1;
        }

        .product-stock {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
            margin-top: auto;
        }

        .stock-available {
            color: #27ae60;
            font-weight: bold;
        }

        .stock-unavailable {
            color: #e74c3c;
            font-weight: bold;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-add-cart {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.75rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: opacity 0.3s;
        }

        .btn-add-cart:hover {
            opacity: 0.9;
        }

        .btn-wishlist {
            width: 45px;
            background: #f0f0f0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #e74c3c;
            font-size: 1.1rem;
        }

        .btn-wishlist:hover {
            background: #e74c3c;
            color: white;
        }

        footer {
            background: #333;
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .footer-section {
            margin-bottom: 1.5rem;
        }

        .footer-section h6 {
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .footer-section a {
            display: block;
            color: #aaa;
            text-decoration: none;
            margin-bottom: 0.5rem;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #555;
            color: #aaa;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 10px;
        }

        .empty-state i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="logo"><i class="bi bi-flower1"></i> Cửa Hàng Hoa</div>
                </div>
                <div class="col-md-5">
                    <div class="search-box">
                        <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="header-icons">
                        <a href="#" title="Yêu thích"><i class="bi bi-heart"></i></a>
                        <a href="#" title="Giỏ hàng"><i class="bi bi-cart"></i><span class="cart-badge">0</span></a>
                        <a href="?router=login" title="Đăng nhập"><i class="bi bi-person-circle"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="banner">
        <div class="container">
            <h1>Các Bông Hoa Tươi Đẹp Nhất</h1>
            <p>Giao hàng miễn phí cho đơn hàng trên 100.000 VND</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="sidebar">
                    <h5><i class="bi bi-funnel"></i> Bộ Lọc</h5>

                    <form id="filterForm" method="GET" action="index.php">
                        <input type="hidden" name="router" value="customers">
                        <input type="hidden" name="controller" value="index">
                        <input type="hidden" name="action" value="index">

                        <div class="sidebar-section mb-3">
                            <h6 style="font-size: 1rem; margin-bottom: 1rem; color: #333;">Danh Mục</h6>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <div class="sidebar-item">
                                        <label class="d-flex justify-content-between align-items-center" style="cursor: pointer;">
                                            <span>
                                                <input type="checkbox" name="categories[]" value="<?php echo $category['category_id']; ?>" class="me-2 filter-checkbox" <?php echo in_array($category['category_id'], $selectedCategories) ? 'checked' : ''; ?>>
                                                <?php echo htmlspecialchars($category['category_name']); ?>
                                            </span>
                                            <span class="badge bg-light text-dark"><?php echo $categoryCounts[$category['category_id']] ?? 0; ?></span>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <hr>

                        <div class="sidebar-section mb-3">
                            <h6 style="font-size: 1rem; margin-bottom: 1rem; color: #333;">Mức Giá</h6>
                            <div class="sidebar-item">
                                <label class="d-flex justify-content-between align-items-center" style="cursor: pointer;">
                                    <span>
                                        <input type="radio" name="price_range" value="" class="me-2 filter-radio" <?php echo empty($_GET['price_range']) ? 'checked' : ''; ?>>
                                        Tất cả
                                    </span>
                                </label>
                            </div>
                            <div class="sidebar-item">
                                <label class="d-flex justify-content-between align-items-center" style="cursor: pointer;">
                                    <span>
                                        <input type="radio" name="price_range" value="0-50000" class="me-2 filter-radio" <?php echo $selectedPriceRange && $selectedPriceRange[0] == 0 && $selectedPriceRange[1] == 50000 ? 'checked' : ''; ?>>
                                        Dưới 50.000 VND
                                    </span>
                                </label>
                            </div>
                            <div class="sidebar-item">
                                <label class="d-flex justify-content-between align-items-center" style="cursor: pointer;">
                                    <span>
                                        <input type="radio" name="price_range" value="50000-100000" class="me-2 filter-radio" <?php echo $selectedPriceRange && $selectedPriceRange[0] == 50000 && $selectedPriceRange[1] == 100000 ? 'checked' : ''; ?>>
                                        50.000 - 100.000 VND
                                    </span>
                                </label>
                            </div>
                            <div class="sidebar-item">
                                <label class="d-flex justify-content-between align-items-center" style="cursor: pointer;">
                                    <span>
                                        <input type="radio" name="price_range" value="100000-200000" class="me-2 filter-radio" <?php echo $selectedPriceRange && $selectedPriceRange[0] == 100000 && $selectedPriceRange[1] == 200000 ? 'checked' : ''; ?>>
                                        100.000 - 200.000 VND
                                    </span>
                                </label>
                            </div>
                            <div class="sidebar-item">
                                <label class="d-flex justify-content-between align-items-center" style="cursor: pointer;">
                                    <span>
                                        <input type="radio" name="price_range" value="200000-<?php echo $maxPrice + 1; ?>" class="me-2 filter-radio" <?php echo $selectedPriceRange && $selectedPriceRange[0] == 200000 ? 'checked' : ''; ?>>
                                        Trên 200.000 VND
                                    </span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="products-section">
                    <h2 class="section-title">Sản Phẩm Nổi Bật</h2>
                    <div class="row">
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <?php $detailUrl = 'index.php?router=customers&controller=detail&action=index&id=' . $product['product_id']; ?>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="product-card" data-category-id="<?php echo $product['category_id']; ?>" data-price="<?php echo isset($product['discounted_price']) ? $product['discounted_price'] : $product['price']; ?>">
                                        <div class="product-img">
                                            <a class="product-link" href="<?php echo $detailUrl; ?>">
                                                <img src="uploads/<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" style="width: 100%; height: 200px; object-fit: cover;">
                                                <div style="display: none; width: 100%; height: 200px; background: #f8f9fa; border: 1px solid #dee2e6; align-items: center; justify-content: center; color: #6c757d; font-size: 14px;">No Image</div>
                                            </a>
                                            <?php if ($product['stock_quantity'] > 0): ?>
                                                <span class="product-badge">Còn Hàng</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="product-body">
                                            <div class="product-content">
                                                <a class="product-link" href="<?php echo $detailUrl; ?>">
                                                    <div class="product-name"><?php echo htmlspecialchars($product['product_name']); ?></div>
                                                </a>
                                                <div class="product-category"><?php echo htmlspecialchars($product['category_name']); ?></div>
                                                <div class="product-price">
                                                    <?php if (isset($product['discounted_price'])): ?>
                                                        <span style="text-decoration: line-through; color: #999; font-size: 0.9rem;"><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</span><br>
                                                        <span style="color: #e74c3c; font-weight: bold;"><?php echo number_format($product['discounted_price'], 0, ',', '.'); ?> VND</span>
                                                        <span class="badge bg-danger ms-1"><?php echo $product['promotion']['discount_type'] === 'percentage' ? '-' . $product['promotion']['discount_value'] . '%' : '-' . number_format($product['promotion']['discount_value'], 0, ',', '.') . ' VND'; ?></span>
                                                    <?php else: ?>
                                                        <?php echo number_format($product['price'], 0, ',', '.'); ?> VND
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="product-stock">
                                                <?php if ($product['stock_quantity'] > 0): ?>
                                                    <span class="stock-available">Còn <?php echo $product['stock_quantity']; ?> sản phẩm</span>
                                                <?php else: ?>
                                                    <span class="stock-unavailable">Hết hàng</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="product-actions">
                                                <button class="btn-add-cart" <?php echo $product['stock_quantity'] > 0 ? '' : 'disabled'; ?>>
                                                    <i class="bi bi-cart-plus"></i> Thêm Giỏ
                                                </button>
                                                <button class="btn-wishlist"><i class="bi bi-heart"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <h4>Không có sản phẩm nào</h4>
                                    <p>Hiện tại không có sản phẩm phù hợp với lựa chọn của bạn</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($totalPages > 1):
                        $queryParams = $_GET;
                        unset($queryParams['page']);
                        $baseUrl = 'index.php';
                        if (!empty($queryParams)) {
                            $baseUrl .= '?' . http_build_query($queryParams) . '&';
                        } else {
                            $baseUrl .= '?';
                        }
                    ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <?php if ($currentPage > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo $baseUrl; ?>page=1">Đầu</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo $baseUrl; ?>page=<?php echo $currentPage - 1; ?>">Trước</a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <?php if ($i >= $currentPage - 2 && $i <= $currentPage + 2): ?>
                                        <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                                            <a class="page-link" href="<?php echo $baseUrl; ?>page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endfor; ?>

                                <?php if ($currentPage < $totalPages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo $baseUrl; ?>page=<?php echo $currentPage + 1; ?>">Sau</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo $baseUrl; ?>page=<?php echo $totalPages; ?>">Cuối</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 footer-section">
                    <h6><i class="bi bi-flower1"></i> Cửa Hàng Hoa</h6>
                    <p>Chúng tôi cung cấp các loại hoa tươi đẹp nhất, được chọn lọc kỹ lưỡng từ những vườn hoa uy tín.</p>
                </div>
                <div class="col-md-3 footer-section">
                    <h6>Hỗ Trợ Khách Hàng</h6>
                    <a href="#"><i class="bi bi-question-circle"></i> Câu Hỏi Thường Gặp</a>
                    <a href="#"><i class="bi bi-telephone"></i> Liên Hệ Chúng Tôi</a>
                    <a href="#"><i class="bi bi-info-circle"></i> Về Chúng Tôi</a>
                    <a href="#"><i class="bi bi-file-text"></i> Chính Sách Bảo Mật</a>
                </div>
                <div class="col-md-3 footer-section">
                    <h6>Chính Sách</h6>
                    <a href="#"><i class="bi bi-truck"></i> Chính Sách Giao Hàng</a>
                    <a href="#"><i class="bi bi-arrow-counterclockwise"></i> Chính Sách Đổi Trả</a>
                    <a href="#"><i class="bi bi-credit-card"></i> Phương Thức Thanh Toán</a>
                    <a href="#"><i class="bi bi-shield-check"></i> Bảo Hành Chất Lượng</a>
                </div>
                <div class="col-md-3 footer-section">
                    <h6>Kết Nối Với Chúng Tôi</h6>
                    <a href="#"><i class="bi bi-facebook"></i> Facebook</a>
                    <a href="#"><i class="bi bi-instagram"></i> Instagram</a>
                    <a href="#"><i class="bi bi-twitter"></i> Twitter</a>
                    <a href="#"><i class="bi bi-youtube"></i> YouTube</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Cửa Hàng Hoa Online. Tất cả các quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('filterForm');
            const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
            const filterRadios = document.querySelectorAll('.filter-radio');

            function submitForm() {
                const pageInput = filterForm.querySelector('input[name="page"]');
                if (pageInput) {
                    pageInput.remove();
                }
                filterForm.submit();
            }

            filterCheckboxes.forEach(cb => cb.addEventListener('change', submitForm));
            filterRadios.forEach(rb => rb.addEventListener('change', submitForm));
        });
    </script>
</body>

</html>

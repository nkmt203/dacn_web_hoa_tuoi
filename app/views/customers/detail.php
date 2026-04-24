<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($product['product_name']); ?> - Cửa Hàng Hoa Online</title>
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

        .breadcrumb {
            background: transparent;
            margin-bottom: 2rem;
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
        }

        .product-image {
            text-align: center;
            background: white;
            padding: 2rem;
            border-radius: 10px;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: contain;
        }

        .product-info {
            background: white;
            padding: 2rem;
            border-radius: 10px;
        }

        .product-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #333;
        }

        .product-category {
            color: #999;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .product-rating {
            color: #f39c12;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .price-section {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .product-price {
            font-size: 2rem;
            color: #e74c3c;
            font-weight: bold;
        }

        .original-price {
            text-decoration: line-through;
            color: #999;
            font-size: 1rem;
        }

        .discount-badge {
            background: #e74c3c;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            display: inline-block;
            margin-left: 1rem;
        }

        .stock-info {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .stock-available {
            color: #27ae60;
            font-weight: bold;
        }

        .stock-unavailable {
            color: #e74c3c;
            font-weight: bold;
        }

        .quantity-section {
            margin-bottom: 1.5rem;
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .quantity-input {
            width: 80px;
            text-align: center;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn-add-cart {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            transition: opacity 0.3s;
        }

        .btn-add-cart:hover {
            opacity: 0.9;
        }

        .btn-wishlist {
            width: 50px;
            background: #f0f0f0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #e74c3c;
            font-size: 1.2rem;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .btn-back:hover {
            background: #5a6268;
            color: white;
        }

        .description-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            margin-top: 2rem;
        }

        .description-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #333;
        }

        .description-text {
            color: #666;
            line-height: 1.8;
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
    </style>
</head>

<body>
    <!-- Header -->
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
                        <a href="#" title="Giỏ hàng"><i class="bi bi-cart"></i></a>
                        <a href="?router=login" title="Đăng nhập"><i class="bi bi-person-circle"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <a href="index.php?router=customers&controller=index&action=index" class="btn-back"><i class="bi bi-arrow-left"></i> Quay Lại</a>

        <nav class="breadcrumb">
            <a href="index.php?router=customers&controller=index&action=index">Trang Chủ</a> /
            <span><?php echo htmlspecialchars($product['product_name']); ?></span>
        </nav>

        <div class="row">
            <div class="col-md-5">
                <div class="product-image">
                    <img src="uploads/<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" style="width: 100%; max-height: 400px; object-fit: cover;">
                    <div style="display: none; width: 100%; height: 400px; background: #f8f9fa; border: 1px solid #dee2e6; align-items: center; justify-content: center; color: #6c757d; font-size: 18px;">No Image Available</div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="product-info">
                    <h1 class="product-title"><?php echo htmlspecialchars($product['product_name']); ?></h1>

                    <div class="product-category">
                        <strong>Danh Mục:</strong> <?php echo htmlspecialchars($category['category_name']); ?>
                    </div>

                    <div class="product-rating">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                        <span style="color: #666;">(45 đánh giá)</span>
                    </div>

                    <div class="price-section">
                        <?php if (isset($product['discounted_price'])): ?>
                            <div class="product-price">
                                <?php echo number_format($product['discounted_price'], 0, ',', '.'); ?> VND
                            </div>
                            <div class="original-price">
                                <?php echo number_format($product['price'], 0, ',', '.'); ?> VND
                            </div>
                            <span class="discount-badge">
                                <?php echo $product['promotion']['discount_type'] === 'percentage' ? '-' . $product['promotion']['discount_value'] . '%' : '-' . number_format($product['promotion']['discount_value'], 0, ',', '.') . ' VND'; ?>
                            </span>
                        <?php else: ?>
                            <div class="product-price">
                                <?php echo number_format($product['price'], 0, ',', '.'); ?> VND
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="stock-info">
                        <?php if ($product['stock_quantity'] > 0): ?>
                            <span class="stock-available">
                                <i class="bi bi-check-circle-fill"></i> Còn <?php echo $product['stock_quantity']; ?> sản phẩm
                            </span>
                        <?php else: ?>
                            <span class="stock-unavailable">
                                <i class="bi bi-x-circle-fill"></i> Hết hàng
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="quantity-section">
                        <label for="quantity"><strong>Số Lượng:</strong></label>
                        <input type="number" id="quantity" class="form-control quantity-input" value="1" min="1" max="<?php echo $product['stock_quantity']; ?>">
                    </div>

                    <div class="action-buttons">
                        <button class="btn-add-cart" <?php echo $product['stock_quantity'] > 0 ? '' : 'disabled'; ?>>
                            <i class="bi bi-cart-plus"></i> Thêm Vào Giỏ Hàng
                        </button>
                        <button class="btn-wishlist"><i class="bi bi-heart"></i></button>
                    </div>

                    <div style="background: #f0f0f0; padding: 1rem; border-radius: 5px; color: #666; font-size: 0.9rem;">
                        <p><i class="bi bi-truck"></i> <strong>Giao hàng miễn phí</strong> cho đơn hàng trên 100.000 VND</p>
                        <p><i class="bi bi-shield-check"></i> <strong>Bảo hành chất lượng</strong> 100% hoặc hoàn tiền</p>
                        <p><i class="bi bi-clock"></i> <strong>Giao hàng nhanh</strong> trong vòng 1-2 ngày</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="description-section">
            <h2 class="description-title">Chi Tiết Sản Phẩm</h2>
            <div class="description-text">
                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 footer-section">
                    <h6><i class="bi bi-flower1"></i> Cửa Hàng Hoa</h6>
                    <p>Chúng tôi cung cấp các loại hoa tươi đẹp nhất, được chọn lọc kỹ lưỡng.</p>
                </div>
                <div class="col-md-3 footer-section">
                    <h6>Hỗ Trợ Khách Hàng</h6>
                    <a href="#">Câu Hỏi Thường Gặp</a>
                    <a href="#">Liên Hệ Chúng Tôi</a>
                    <a href="#">Về Chúng Tôi</a>
                </div>
                <div class="col-md-3 footer-section">
                    <h6>Chính Sách</h6>
                    <a href="#">Chính Sách Giao Hàng</a>
                    <a href="#">Chính Sách Đổi Trả</a>
                    <a href="#">Bảo Hành Chất Lượng</a>
                </div>
                <div class="col-md-3 footer-section">
                    <h6>Kết Nối Với Chúng Tôi</h6>
                    <a href="#">Facebook</a>
                    <a href="#">Instagram</a>
                    <a href="#">Twitter</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Cửa Hàng Hoa Online. Tất cả các quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

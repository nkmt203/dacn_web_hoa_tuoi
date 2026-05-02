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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giỏ hàng của bạn - Bloom & Co</title>

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

    .cart-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .table-cart th {
        font-weight: 600;
        color: #6c757d;
        border-bottom: 2px solid #f1f1f1;
        padding-bottom: 1rem;
    }

    .table-cart td {
        vertical-align: middle;
        border-bottom: 1px solid #f9f9f9;
        padding: 1.5rem 0;
    }

    .cart-img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 12px;
    }

    .product-title {
        font-weight: 600;
        color: #2d2a24;
        text-decoration: none;
        transition: color 0.2s;
    }

    .product-title:hover {
        color: #e05a7e;
    }

    .btn-remove {
        color: #dc3545;
        background: rgba(220, 53, 69, 0.1);
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .btn-remove:hover {
        background: #dc3545;
        color: white;
    }

    .summary-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        position: sticky;
        top: 100px;
    }

    .checkout-btn {
        background: linear-gradient(135deg, #e05a7e, #c4456c);
        border: none;
        padding: 14px 28px;
        font-size: 1.05rem;
        font-weight: 600;
        border-radius: 50px;
        width: 100%;
        color: white;
        transition: all 0.2s;
    }

    .checkout-btn:hover {
        background: linear-gradient(135deg, #c4456c, #e05a7e);
        transform: translateY(-2px);
        color: white;
    }

    .continue-btn {
        background: #f1f1f1;
        border: none;
        padding: 14px 28px;
        font-size: 1.05rem;
        font-weight: 600;
        border-radius: 50px;
        width: 100%;
        color: #495057;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        transition: all 0.2s;
    }

    .continue-btn:hover {
        background: #e2e2e2;
        color: #212529;
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
                    <a href="index.php?router=customers"
                        class="text-decoration-none text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-flower1 fs-2 text-pink-400" style="color: #e05a7e;"></i>
                        <span class="heading-font fs-4 fw-bold">Bloom & Co</span>
                    </a>
                </div>
                <div class="col-md-5">
                    <form action="index.php" method="GET">
                        <input type="hidden" name="router" value="customers">
                        <input type="text" name="search" class="form-control rounded-pill"
                            placeholder="Tìm kiếm hoa tươi...">
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
                    <a href="index.php?router=customers&controller=cart&action=listCart"
                        class="me-4 text-dark fs-4 position-relative">
                        <i class="bi bi-cart-fill" style="color: #e05a7e;"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill"
                            style="font-size: 0.7rem;"><?= $cartCount ?></span>
                    </a>
                    <?php if (isset($_SESSION['customer'])): ?>
                    <span class="me-2 fw-medium">Xin chào,
                        <?= htmlspecialchars($_SESSION['customer']['username']) ?></span>
                    <a href="index.php?router=logout" class="text-danger ms-2"><i class="bi bi-box-arrow-right"></i></a>
                    <?php else: ?>
                    <a href="index.php?router=login" class="text-dark ms-2"><i class="bi bi-person-circle fs-4"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div class="container main-container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?router=customers"
                        class="text-decoration-none text-muted">Trang chủ</a></li>
                <li class="breadcrumb-item active heading-font fw-bold" style="color: #e05a7e;">Giỏ hàng của bạn</li>
            </ol>
        </nav>

        <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= $_SESSION['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $_SESSION['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="cart-card">
                    <h2 class="heading-font fw-bold mb-4 fs-4">Sản phẩm trong giỏ</h2>
                    <div class="table-responsive">
                        <table class="table table-borderless table-cart mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Sản phẩm</th>
                                    <th class="text-center">Đơn giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Thành tiền</th>
                                    <th class="text-center">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; ?>
                                <?php foreach ($listCart as $item): ?>
                                <?php
                                    $unitPrice = isset($item['discounted_price']) ? $item['discounted_price'] : $item['price'];
                                    $subtotal = $unitPrice * $item['quantity'];
                                    $total += $subtotal;
                                    $detailUrl = "index.php?router=customers&controller=detail&action=index&id=" . $item['product_id'];
                                    ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <a href="<?= $detailUrl ?>">
                                                <img src="uploads/<?= htmlspecialchars($item['image_url']) ?>"
                                                    alt="<?= htmlspecialchars($item['product_name']) ?>"
                                                    class="cart-img shadow-sm"
                                                    onerror="this.src='https://placehold.co/100x100?text=Hoa';">
                                            </a>
                                            <div>
                                                <a href="<?= $detailUrl ?>"
                                                    class="product-title fs-6 d-block mb-1"><?= htmlspecialchars($item['product_name']) ?></a>
                                                <?php if ($item['stock_quantity'] < $item['quantity']): ?>
                                                <small class="text-danger"><i class="bi bi-exclamation-circle"></i> Tồn
                                                    kho không đủ (còn <?= $item['stock_quantity'] ?>)</small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center fw-medium">
                                        <?php if (isset($item['discounted_price'])): ?>
                                            <span class="text-danger fw-bold d-block"><?= number_format($item['discounted_price'], 0, ',', '.') ?>đ</span>
                                            <small class="text-muted text-decoration-line-through"><?= number_format($item['price'], 0, ',', '.') ?>đ</small>
                                        <?php else: ?>
                                            <?= number_format($item['price'], 0, ',', '.') ?>đ
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <form action="index.php?router=customers&controller=cart&action=updateCart" method="POST" class="d-inline-block m-0">
                                            <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                            <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                            <div class="input-group input-group-sm" style="width: 110px; border-radius: 20px; overflow: hidden; background: #f8f9fa; border: 1px solid #dee2e6;">
                                                <button class="btn btn-light border-0 px-2" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown(); this.form.submit();" style="background: transparent;">-</button>
                                                <input type="number" name="quantity" class="form-control border-0 text-center fw-bold bg-transparent px-1" value="<?= $item['quantity'] ?>" min="1" max="<?= $item['stock_quantity'] ?>" onchange="this.form.submit()" style="box-shadow: none;">
                                                <button class="btn btn-light border-0 px-2" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp(); this.form.submit();" style="background: transparent;">+</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-end fw-bold" style="color: #e05a7e;">
                                        <?= number_format($subtotal, 0, ',', '.') ?>đ
                                    </td>
                                    <td class="text-center">
                                        <a href="index.php?router=customers&controller=cart&action=deleteCart&cart_id=<?= $item['cart_id'] ?>"
                                            class="btn-remove"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')"
                                            title="Xóa">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-card">
                    <h3 class="heading-font fw-bold mb-4 fs-4 border-bottom pb-3">Tóm tắt đơn hàng</h3>

                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>Tạm tính (<?= count($listCart) ?> sản phẩm)</span>
                        <span><?= number_format($total, 0, ',', '.') ?>đ</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4 pb-3 border-bottom text-muted">
                        <span>Phí vận chuyển</span>
                        <span>Miễn phí</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="fs-5 fw-bold">Tổng cộng</span>
                        <span class="fs-4 fw-bold"
                            style="color: #e05a7e;"><?= number_format($total, 0, ',', '.') ?>đ</span>
                    </div>

                    <a href="index.php?router=customers&controller=checkout&action=index"
                        class="btn checkout-btn mb-3 d-flex align-items-center justify-content-center gap-2">
                        Tiến hành thanh toán <i class="bi bi-arrow-right"></i>
                    </a>

                    <a href="index.php?router=customers" class="btn continue-btn">
                        <i class="bi bi-arrow-left me-2"></i> Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
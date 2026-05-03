<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<?php
/**
 * @var array $order
 */
?>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Đặt hàng thành công - FlowerTown</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #e91e63;
            --primary-gradient: linear-gradient(135deg, #e91e63, #c2185b);
            --bg-color: #FFF5F7;
            --card-bg: #ffffff;
            --radius-lg: 32px;
            --radius-md: 20px;
            --shadow-md: 0 20px 50px rgba(224, 90, 126, 0.08);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
        }

        .success-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 3.5rem 2.5rem;
            box-shadow: var(--shadow-md);
            max-width: 650px;
            width: 100%;
            text-align: center;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(224, 90, 126, 0.1);
        }

        .success-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: var(--primary-gradient);
        }

        .success-icon-wrapper {
            width: 100px;
            height: 100px;
            background: #e8f5e9;
            color: #2e7d32;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            margin: 0 auto 2rem;
            animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        @keyframes scaleIn {
            from { transform: scale(0); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .heading-font {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            color: #2d2a24;
            margin-bottom: 1rem;
        }

        .order-code-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #fdf2f5;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 800;
            color: var(--primary-color);
            margin: 1rem 0 2.5rem;
            font-size: 1.1rem;
            border: 1px dashed var(--primary-color);
        }

        .info-section {
            text-align: left;
            background: #fafafa;
            border-radius: var(--radius-md);
            padding: 2rem;
            margin-bottom: 2.5rem;
            border: 1px solid #f0f0f0;
        }

        .info-label {
            font-weight: 800;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #9e9e9e;
            margin-bottom: 1rem;
            display: block;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .info-item p {
            margin-bottom: 0.4rem;
            font-size: 0.9rem;
            color: #4a4a4a;
        }

        .info-item strong {
            color: #2d2a24;
        }

        .total-summary {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-action {
            padding: 1.2rem;
            border-radius: 18px;
            font-weight: 800;
            transition: var(--transition);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .btn-primary-custom {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 10px 20px rgba(224, 90, 126, 0.2);
        }

        .btn-primary-custom:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(224, 90, 126, 0.3);
            color: white;
        }

        .btn-outline-custom {
            background: white;
            color: #616161;
            border: 2px solid #eeeeee;
        }

        .btn-outline-custom:hover {
            background: #fdfdfd;
            border-color: #bdbdbd;
            color: #212121;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .success-card {
                padding: 2.5rem 1.5rem;
            }
            .info-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .info-section {
                padding: 1.5rem;
            }
            .border-md-end {
                border-right: none !important;
                border-bottom: 1px solid #eee;
                padding-bottom: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="success-card animate-fade-up">
        <div class="success-icon-wrapper">
            <i class="bi bi-check2-circle"></i>
        </div>
        
        <h1 class="heading-font">Đặt hàng thành công!</h1>
        <p class="text-muted px-md-4">Cảm ơn bạn đã tin tưởng FlowerTown. Chúng tôi sẽ chuẩn bị những đóa hoa tươi đẹp nhất để gửi đến bạn.</p>
        
        <div class="order-code-badge">
            <i class="bi bi-tag-fill"></i> Mã đơn: <?= htmlspecialchars($order['order_code']) ?>
        </div>
        
        <div class="info-section">
            <div class="info-grid">
                <div class="info-item border-md-end">
                    <span class="info-label">Người đặt hàng</span>
                    <p><strong>Họ tên:</strong> <?= htmlspecialchars($_SESSION['customer']['full_name']) ?></p>
                    <p><strong>Số ĐT:</strong> <?= htmlspecialchars($_SESSION['customer']['phone'] ?? 'N/A') ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['customer']['email'] ?? 'N/A') ?></p>
                </div>
                <div class="info-item">
                    <span class="info-label">Người nhận hàng</span>
                    <p><strong>Họ tên:</strong> <?= htmlspecialchars($order['receiver_name']) ?></p>
                    <p><strong>Số ĐT:</strong> <?= htmlspecialchars($order['receiver_phone']) ?></p>
                    <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['delivery_address']) ?></p>
                </div>
            </div>
            
            <div class="total-summary">
                <span class="fw-bold text-muted small text-uppercase">Tổng thanh toán</span>
                <span class="text-danger fw-bold fs-4"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</span>
            </div>
        </div>

        <div class="d-grid gap-3">
            <a href="index.php?router=customers&controller=order&action=listOrders" class="btn-action btn-primary-custom">
                <i class="bi bi-receipt"></i> XEM ĐƠN HÀNG CỦA TÔI
            </a>
            <a href="index.php?router=customers" class="btn-action btn-outline-custom">
                <i class="bi bi-house-door"></i> QUAY LẠI TRANG CHỦ
            </a>
        </div>
        
        <div class="mt-4 text-muted small">
            <i class="bi bi-shield-check me-1"></i> Giao dịch của bạn luôn được bảo mật tuyệt đối
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

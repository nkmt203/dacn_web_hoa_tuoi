<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Giỏ hàng trống - FlowerTown</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2b5e3b;
            --secondary-color: #9b6b43;
            --accent-color: #c7a17a;
            --bg-color: #fefaf5;
            --card-bg: #ffffff;
            --text-main: #2d2a24;
            --text-muted: #6b5a4c;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --radius-lg: 32px;
            --shadow-md: 0 12px 30px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 0.8rem 0;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            justify-content: center;
        }

        .logo i {
            -webkit-text-fill-color: var(--secondary-color);
            font-size: 1.8rem;
        }

        .empty-cart-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 5rem 2rem;
            box-shadow: var(--shadow-md);
            text-align: center;
            max-width: 600px;
            margin: auto;
        }

        .empty-icon {
            font-size: 6rem;
            color: #f1e4d8;
            margin-bottom: 2rem;
            display: block;
        }

        .heading-font {
            font-family: 'Playfair Display', serif;
        }

        .btn-shop {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            font-weight: 800;
            font-size: 1.1rem;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 2rem;
        }

        .btn-shop:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(43, 94, 59, 0.2);
            color: white;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-up {
            animation: fadeUp 0.8s cubic-bezier(0.2, 0, 0, 1) forwards;
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="container text-center">
            <a href="index.php?router=customers" class="logo">
                <i class="bi bi-flower2"></i> FlowerTown
            </a>
        </div>
    </header>

    <div class="container flex-grow-1 d-flex align-items-center">
        <div class="empty-cart-card animate-fade-up">
            <i class="bi bi-bag-heart empty-icon"></i>
            <h1 class="heading-font fw-bold mb-3 fs-1">Giỏ hàng đang chờ...</h1>
            <p class="text-muted fs-5">Những đóa hoa đẹp nhất vẫn đang chờ bạn khám phá. Hãy lấp đầy giỏ hàng bằng yêu thương nhé!</p>
            
            <a href="index.php?router=customers" class="btn-shop">
                <i class="bi bi-flower2"></i> KHÁM PHÁ NGAY
            </a>
        </div>
    </div>

    <footer class="py-4 text-center">
        <p class="text-muted small">© 2024 FlowerTown. Kiến tạo không gian từ những đóa hoa.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

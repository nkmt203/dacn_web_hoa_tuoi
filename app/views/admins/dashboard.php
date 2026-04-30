<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 + Icons + Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at 10% 20%, rgba(241, 245, 249, 1) 0%, rgba(226, 232, 240, 1) 100%);
            overflow-x: hidden;
            color: #0a0c10;
        }

        /* ========= SIDEBAR - NEO-GLASS ========= */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100%;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 12px 0 40px rgba(0, 0, 0, 0.08);
            z-index: 1050;
            transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            overflow-y: auto;
            scrollbar-width: thin;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        /* brand area */
        .sidebar .brand {
            padding: 32px 24px 24px 28px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 24px;
        }

        .logo-glow {
            font-size: 1.9rem;
            font-weight: 800;
            background: linear-gradient(135deg, #FFFFFF, #A5F3FC, #38BDF8);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .brand small {
            font-size: 0.7rem;
            color: #94a3b8;
            font-weight: 400;
            letter-spacing: 1px;
        }

        /* nav links */
        .sidebar .nav {
            padding: 0 5px;
        }

        .sidebar .nav-link {
            color: #e0e7ff;
            padding: 12px 18px;
            margin: 6px 0;
            border-radius: 20px;
            transition: all 0.25s ease;
            font-weight: 500;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 14px;
            backdrop-filter: blur(4px);
        }

        .sidebar .nav-link i {
            width: 26px;
            font-size: 1.25rem;
            text-align: center;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.12);
            color: white;
            transform: translateX(6px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(95deg, rgba(56, 189, 248, 0.25), rgba(59, 130, 246, 0.2));
            color: white;
            border-left: 3px solid #38bdf8;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* dropdown menu */
        .sidebar .nav-item .dropdown-toggle {
            justify-content: space-between;
        }

        .sidebar .nav-item .dropdown-toggle::after {
            margin-left: auto;
            transition: transform 0.25s;
        }

        .sidebar .nav-item.open .dropdown-toggle::after {
            transform: rotate(180deg);
        }

        .sidebar .dropdown {
            margin-left: 4px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease-out;
        }

        .sidebar .nav-item.open .dropdown {
            max-height: 500px;
        }

        .sidebar .dropdown .nav-link {
            padding: 8px 16px 8px 40px;
            font-size: 0.85rem;
            gap: 12px;
        }

        .sidebar .dropdown .nav-link i {
            font-size: 0.85rem;
        }

        hr.bg-light {
            background: rgba(255, 255, 255, 0.1);
            margin: 16px 0;
        }

        /* ========= TOP NAVBAR - GLASS PREMIUM ========= */
        .navbar-admin {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.7);
            padding: 0.7rem 2rem;
            z-index: 1040;
        }

        .btn-glass {
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 40px;
            color: #1e293b;
            padding: 8px 18px;
            backdrop-filter: blur(4px);
            transition: 0.2s;
        }

        .btn-glass:hover {
            background: white;
            transform: scale(0.96);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.05);
        }

        .avatar-icon {
            font-size: 2.6rem;
            background: linear-gradient(145deg, #3b82f6, #06b6d4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* ========= MAIN CONTENT ========= */
        .main-content {
            margin-left: 230px;
            transition: margin-left 0.4s ease;
            padding: 110px 32px 50px 32px;
            min-height: 100vh;
            width: auto;
        }

        .sidebar.collapsed~.main-content {
            margin-left: 0;
        }

        /* Glass card hiện đại */
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 36px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 54px;
            height: 54px;
            background: linear-gradient(135deg, #eef2ff, #e0f2fe);
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: #2563eb;
        }

        .table-modern {
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .table-modern tr {
            background: white;
            border-radius: 24px;
            transition: 0.2s;
        }

        .table-modern td,
        .table-modern th {
            border: none;
            padding: 16px 20px;
        }

        .badge-soft {
            background: rgba(59, 130, 246, 0.15);
            color: #1e40af;
            border-radius: 100px;
            font-weight: 600;
            padding: 6px 16px;
        }

        /* responsive */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 100px 16px 40px;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.collapsed {
                transform: translateX(0);
            }

            .glass-card {
                backdrop-filter: blur(8px);
            }
        }

        /* subtle scroll */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #e2e8f0;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR HIỆN ĐẠI -->
    <div class="sidebar" id="adminSidebar">
        <div class="brand">
            <div class="logo-glow">✦ K.M.<span style="color:#bae6fd;">Twain</span></div>
            <small>Quản trị thông minh · AI Ready</small>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link active" href="index.php?controller=dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span class="nav-text">Tổng quan</span>
            </a>
            <a class="nav-link" href="index.php?controller=product&action=listProduct">
                <i class="fas fa-cube"></i>
                <span class="nav-text">Sản phẩm</span>
            </a>
            <a class="nav-link" href="index.php?controller=category&action=listCategory">
                <i class="fa-solid fa-layer-group"></i>
                <span class="nav-text">Danh mục</span>
            </a>

            <!-- Đơn hàng dropdown -->
            <div class="nav-item">
                <a class="nav-link dropdown-toggle" href="#">
                    <i class="fas fa-truck-fast"></i>
                    <span class="nav-text">Đơn hàng</span>
                </a>
                <div class="dropdown">
                    <a class="nav-link" href="index.php?controller=order&action=listOrder"><i class="fas fa-circle"></i> Tất cả đơn</a>
                    <a class="nav-link" href="index.php?controller=order&action=listOrder&status=pending"><i class="fas fa-clock"></i> Chờ xác nhận</a>
                    <a class="nav-link" href="index.php?controller=order&action=listOrder&status=confirmed"><i class="fas fa-check-circle"></i> Đã xác nhận</a>
                    <a class="nav-link" href="index.php?controller=order&action=listOrder&status=shipping"><i class="fas fa-shipping-fast"></i> Đang giao</a>
                    <a class="nav-link" href="index.php?controller=order&action=listOrder&status=completed"><i class="fas fa-flag-checkered"></i> Hoàn thành</a>
                    <a class="nav-link" href="index.php?controller=order&action=listOrder&status=cancelled"><i class="fas fa-ban"></i> Đã hủy</a>
                </div>
            </div>

            <!-- Khuyến mãi dropdown -->
            <div class="nav-item">
                <a class="nav-link dropdown-toggle" href="#">
                    <i class="fas fa-tags"></i>
                    <span class="nav-text">Khuyến mãi</span>
                </a>
                <div class="dropdown">
                    <a class="nav-link" href="index.php?controller=promotion&action=listAllProductPromotion">🎁 Tất cả SPKM</a>
                    <a class="nav-link" href="index.php?controller=promotion&action=listPromotion">💸 Code khuyến mãi</a>
                    <a class="nav-link" href="index.php?controller=promotion&action=listApplyProductPromotion">🔥 Đang khuyến mãi</a>
                    <a class="nav-link" href="index.php?controller=promotion&action=listExpiredProductPromotion">⏰ Hết hạn</a>
                    <a class="nav-link" href="index.php?controller=promotion&action=listInactiveProductPromotion">⛔ Tạm ngưng</a>
                    <a class="nav-link" href="index.php?controller=promotion&action=applyProductPromotion">✨ Áp dụng KM</a>
                </div>
            </div>

            <a class="nav-link" href="#"><i class="fa-regular fa-message"></i> Bình luận</a>

            <!-- Tài khoản -->
            <div class="nav-item">
                <a class="nav-link dropdown-toggle" href="#">
                    <i class="fas fa-user-shield"></i>
                    <span class="nav-text">Tài khoản</span>
                </a>
                <div class="dropdown">
                    <a class="nav-link" href="index.php?controller=accountAdmin&action=listAccountAdmin"><i class="fas fa-crown"></i> Quản trị viên</a>
                    <a class="nav-link" href="index.php?controller=accountCustomer&action=listAccountCustomer"><i class="fas fa-users"></i> Khách hàng</a>
                </div>
            </div>

            <a class="nav-link" href="#"><i class="fas fa-sliders-h"></i> Cài đặt</a>
            <hr class="bg-light opacity-25">
            <a class="nav-link text-danger" href="../../../index.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
        </nav>
    </div>

    <!-- TOP BAR -->
    <nav class="navbar navbar-expand navbar-admin fixed-top">
        <div class="container-fluid">
            <button class="btn btn-glass" type="button" id="toggleSidebarBtn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" style="color:#0f172a; gap: 12px;">
                        <i class="fa-solid fa-circle-user avatar-icon"></i>
                        <span class="d-none d-sm-inline fw-semibold">
                            <?php
                            if (isset($_SESSION['admin'])) {
                                echo htmlspecialchars($_SESSION['admin']['username']);
                            } else {
                                echo "Quản trị viên";
                            }
                            ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 mt-2">
                        <li><a class="dropdown-item rounded-3" href="profile.php"><i class="fas fa-id-card me-2"></i>Hồ sơ</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger rounded-3" href="../../../index.php"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT - DYNAMIC VIEW -->
    <div class="main-content" id="mainContent">
        <?php
        if (isset($viewFile) && file_exists($viewFile)) {
            include $viewFile;
        } else {
            // Hiển thị dashboard mẫu hiện đại nếu không có view động
            echo '
        <div class="container-fluid px-0">
            <div class="d-flex justify-content-between flex-wrap gap-3 mb-5">
                <div>
                    <h1 class="display-6 fw-bold" style="letter-spacing: -0.02em;">Chào mừng trở lại 👋</h1>
                    <p class="text-secondary">Quản lý tập trung, phân tích thông minh</p>
                </div>
                <div>
                    <button class="btn btn-dark rounded-5 px-4"><i class="fas fa-calendar-alt me-2"></i>Hôm nay: ' . date('d/m/Y') . '</button>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-6 col-xl-3">
                    <div class="glass-card p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><span class="text-secondary">Tổng doanh thu</span><h2 class="fw-bold mt-2">₫156.8M</h2><span class="badge-soft">⬆️ +12.5%</span></div>
                            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="glass-card p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><span class="text-secondary">Đơn hàng mới</span><h2 class="fw-bold mt-2">284</h2><span class="badge-soft">⬆️ +8%</span></div>
                            <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="glass-card p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><span class="text-secondary">Sản phẩm</span><h2 class="fw-bold mt-2">1,246</h2><span class="badge-soft">+32 mới</span></div>
                            <div class="stat-icon"><i class="fas fa-boxes"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="glass-card p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><span class="text-secondary">Khách hàng</span><h2 class="fw-bold mt-2">3,421</h2><span class="badge-soft">+15%</span></div>
                            <div class="stat-icon"><i class="fas fa-user-friends"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0">📦 Đơn hàng gần đây</h4>
                    <a href="#" class="text-decoration-none">Xem tất cả →</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-modern align-middle">
                        <thead><tr><th>Mã đơn</th><th>Khách hàng</th><th>Tổng tiền</th><th>Trạng thái</th><th></th></tr></thead>
                        <tbody>
                            <tr><td>#ORD-001</td><td>Nguyễn Minh Anh</td><td>₫2,450,000</td><td><span class="badge-soft">Đã xác nhận</span></td><td><i class="fas fa-chevron-right opacity-50"></i></td></tr>
                            <tr><td>#ORD-002</td><td>Trần Hoàng Nam</td><td>₫890,000</td><td><span class="badge-soft">Chờ xác nhận</span></td><td><i class="fas fa-chevron-right opacity-50"></i></td></tr>
                            <tr><td>#ORD-003</td><td>Lê Thảo Vy</td><td>₫3,200,000</td><td><span class="badge-soft">Hoàn thành</span></td><td><i class="fas fa-chevron-right opacity-50"></i></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>';
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function() {
            const sidebar = document.getElementById('adminSidebar');
            const toggleBtn = document.getElementById('toggleSidebarBtn');

            function toggleSidebar() {
                sidebar.classList.toggle('collapsed');
                localStorage.setItem('adminSidebarCollapsed', sidebar.classList.contains('collapsed'));
            }
            if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);

            const saved = localStorage.getItem('adminSidebarCollapsed');
            if (saved === 'true') sidebar.classList.add('collapsed');
            else sidebar.classList.remove('collapsed');

            // dropdown sidebar
            const toggles = document.querySelectorAll('.sidebar .nav-item > .nav-link.dropdown-toggle');

            function closeAllDropdown(except = null) {
                document.querySelectorAll('.sidebar .nav-item.open').forEach(el => {
                    if (except !== el) el.classList.remove('open');
                });
            }
            toggles.forEach(toggle => {
                toggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    const parent = toggle.closest('.nav-item');
                    const isOpen = parent.classList.contains('open');
                    closeAllDropdown(parent);
                    if (!isOpen) parent.classList.add('open');
                    else parent.classList.remove('open');
                });
            });

            // active link helper
            function setActive() {
                const current = window.location.href;
                document.querySelectorAll('.sidebar .nav-link').forEach(link => {
                    let href = link.getAttribute('href');
                    if (href && href !== '#' && current.includes(href.split('?')[0])) {
                        link.classList.add('active');
                    } else if (href === 'index.php?controller=dashboard' && (current.includes('controller=dashboard') || current.endsWith('index.php') || current.split('?')[1] === undefined)) {
                        link.classList.add('active');
                    }
                });
            }
            setActive();

            // auto close sidebar on mobile after click
            const allLinks = document.querySelectorAll('.sidebar .nav-link');
            allLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 768 && !sidebar.classList.contains('collapsed')) {
                        sidebar.classList.add('collapsed');
                        localStorage.setItem('adminSidebarCollapsed', 'true');
                    }
                });
            });
        })();
    </script>
</body>

</html>
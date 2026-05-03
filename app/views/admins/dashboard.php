<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Admin Dashboard | K.M.Twain</title>

    <!-- Bootstrap 5 + Icons + Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap"
        rel="stylesheet">

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

    /* ========= SIDEBAR ========= */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 260px;
        height: 100vh;
        background: rgba(15, 23, 42, 0.94);
        backdrop-filter: blur(18px);
        border-right: 1px solid rgba(255, 255, 255, 0.15);
        box-shadow: 12px 0 40px rgba(0, 0, 0, 0.12);
        z-index: 1050;
        transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        overflow: visible;
    }

    .sidebar-inner {
        height: 100%;
        overflow-y: auto;
        overflow-x: visible;
        scrollbar-width: thin;
    }

    .sidebar.collapsed {
        width: 80px;
    }

    .sidebar.show-mobile {
        transform: translateX(0) !important;
    }

    .sidebar.collapsed .nav-text,
    .sidebar.collapsed .dropdown-default {
        display: none;
    }

    /* Brand */
    .brand {
        padding: 24px 18px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .brand-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sidebar-toggle-btn {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        color: #e2e8f0;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .sidebar-toggle-btn:hover {
        background: #3b82f6;
        color: white;
        transform: scale(0.96);
        border-color: #3b82f6;
    }

    .logo-glow {
        font-size: 1.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #FFFFFF, #A5F3FC, #38BDF8);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        white-space: nowrap;
    }

    .logo-icon-small {
        display: none;
        font-size: 1.6rem;
        background: linear-gradient(135deg, #fff, #7dd3fc);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .sidebar.collapsed .logo-glow {
        display: none;
    }

    .sidebar.collapsed .logo-icon-small {
        display: block;
    }

    .sidebar.collapsed .brand-left {
        justify-content: center;
        width: 100%;
        gap: 0;
    }

    .sidebar.collapsed .brand {
        justify-content: center;
        padding: 24px 0;
    }

    .sidebar.collapsed .sidebar-toggle-btn {
        margin: 0 auto;
    }

    /* ========= DROPDOWN COLLAPSED ========= */
    .sidebar.collapsed .nav-item {
        position: relative;
    }

    .sidebar.collapsed .dropdown-collapsed {
        position: fixed;
        top: 0;
        left: 0;
        min-width: 250px;
        padding: 10px 0;
        border-radius: 18px;
        background: rgba(15, 23, 42, 0.88);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.28);
        z-index: 99999;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transform: translateX(8px) scale(0.96);
        transform-origin: left center;
        transition: opacity 0.22s ease, transform 0.22s ease, visibility 0.22s ease;
    }

    .sidebar.collapsed .nav-item.show-flyout .dropdown-collapsed {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        transform: translateX(0) scale(1);
    }

    .sidebar.collapsed .dropdown-collapsed .dropdown-item-custom {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 16px;
        margin: 4px 8px;
        border-radius: 12px;
        color: #e2e8f0;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        white-space: nowrap;
        transition: all 0.2s ease;
    }

    .sidebar.collapsed .dropdown-collapsed .dropdown-item-custom i {
        width: 18px;
        text-align: center;
        color: #94a3b8;
        font-size: 0.95rem;
    }

    .sidebar.collapsed .dropdown-collapsed .dropdown-item-custom:hover {
        background: rgba(59, 130, 246, 0.18);
        color: #fff;
    }

    .sidebar.collapsed .dropdown-collapsed .dropdown-item-custom:hover i {
        color: #60a5fa;
    }

    /* ========= DROPDOWN EXPANDED ========= */
    .sidebar:not(.collapsed) .dropdown-collapsed {
        display: none;
    }

    .sidebar:not(.collapsed) .dropdown-default {
        display: block;
        margin-left: 36px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease-out;
    }

    .sidebar:not(.collapsed) .nav-item.open .dropdown-default {
        max-height: 500px;
    }

    .sidebar:not(.collapsed) .dropdown-default .nav-link {
        padding: 8px 16px 8px 28px;
        font-size: 0.8rem;
        gap: 10px;
    }

    /* ========= NAV ========= */
    .sidebar .nav-link {
        color: #cbd5e1;
        padding: 12px 16px;
        margin: 4px 0;
        border-radius: 14px;
        transition: all 0.2s ease;
        font-weight: 500;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 12px;
        white-space: nowrap;
        cursor: pointer;
        text-decoration: none;
    }

    .sidebar .nav-link>i:first-child {
        width: 24px;
        font-size: 1.1rem;
        text-align: center;
        flex-shrink: 0;
    }

    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateX(4px);
    }

    .sidebar.collapsed .nav-link {
        justify-content: flex-start;
        padding: 12px;
        position: relative;
    }

    .sidebar.collapsed .nav-link>i:first-child {
        width: 100%;
        text-align: center;
        margin: 0;
        font-size: 1.3rem;
    }

    .sidebar.collapsed .nav-link>i:first-child {
        margin: 0;
        font-size: 1.3rem;
    }

    .sidebar.collapsed .nav-link:hover {
        transform: translateX(0);
        background: rgba(59, 130, 246, 0.25);
    }

    .sidebar .nav-link.active {
        background: rgba(59, 130, 246, 0.2);
        color: white;
        border-left: 3px solid #3b82f6;
    }

    hr.bg-light {
        background: rgba(255, 255, 255, 0.1);
        margin: 12px 0;
    }

    /* ========= TOP NAVBAR ========= */
    .navbar-admin {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        border-bottom: 1px solid rgba(255, 255, 255, 0.6);
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
    }

    .avatar-icon {
        font-size: 2.4rem;
        color: #3b82f6;
    }

    /* ========= MAIN ========= */
    .main-content {
        margin-left: 260px;
        transition: margin-left 0.3s ease;
        padding: 100px 32px 50px 32px;
        min-height: 100vh;
    }

    .sidebar.collapsed~.main-content {
        margin-left: 80px;
    }

    /* ========= DROPDOWN ARROW ========= */
    .dropdown-arrow {
        margin-left: auto;
        width: auto !important;
        font-size: 0.8rem !important;
        transition: transform 0.25s ease;
        opacity: 0.8;
    }

    /* Khi dropdown mở thì xoay mũi tên */
    .nav-item.open>.nav-link .dropdown-arrow,
    .nav-item.show-flyout>.nav-link .dropdown-arrow {
        transform: rotate(180deg);
        opacity: 1;
    }

    .sidebar.collapsed .nav-link .dropdown-arrow {
        display: block !important;
        position: absolute;
        right: 10px;
        font-size: 0.65rem !important;
        opacity: 0.7;
    }

    .nav-dropdown-toggle:hover .dropdown-arrow {
        transform: translateY(1px);
    }

    .nav-dropdown-toggle {
        width: 100%;
    }

    /* ========= MOBILE ========= */
    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 90px 16px 40px;
        }

        .sidebar {
            transform: translateX(-100%);
            width: 260px;
        }

        .sidebar.collapsed {
            transform: translateX(0);
            width: 260px;
        }

        .sidebar.collapsed .nav-text {
            display: inline;
        }

        .sidebar.collapsed .logo-glow {
            display: block;
        }

        .sidebar.collapsed .logo-icon-small {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            justify-content: flex-start;
        }

        .sidebar.collapsed .dropdown-collapsed {
            left: 70px;
        }
    }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar" id="adminSidebar">
        <div class="sidebar-inner">

            <div class="brand">
                <div class="brand-left">
                    <button class="sidebar-toggle-btn d-none d-md-flex" type="button" id="toggleSidebarBtnDesktop">
                        <i class="fas fa-bars"></i>
                    </button>
                    <button class="sidebar-toggle-btn d-md-none" type="button" id="closeSidebarBtnMobile">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="logo-glow">✦ K.M.<span style="color:#bae6fd;">Twain</span></div>
                    <div class="logo-icon-small">✦</div>
                </div>
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
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fas fa-truck-fast"></i>
                        <span class="nav-text">Đơn hàng</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <!-- Dropdown cho chế độ mở rộng (click) -->
                    <div class="dropdown-default">
                        <a class="nav-link" href="index.php?controller=order&action=listOrder"><i
                                class="fas fa-circle"></i> <span class="nav-text">Tất cả đơn</span></a>
                        <a class="nav-link" href="index.php?controller=order&action=listOrder&status=pending"><i
                                class="fas fa-clock"></i> <span class="nav-text">Chờ xác nhận</span></a>
                        <a class="nav-link" href="index.php?controller=order&action=listOrder&status=confirmed"><i
                                class="fas fa-check-circle"></i> <span class="nav-text">Đã xác nhận</span></a>
                        <a class="nav-link" href="index.php?controller=order&action=listOrder&status=shipping"><i
                                class="fas fa-shipping-fast"></i> <span class="nav-text">Đang giao</span></a>
                        <a class="nav-link" href="index.php?controller=order&action=listOrder&status=completed"><i
                                class="fas fa-flag-checkered"></i> <span class="nav-text">Hoàn thành</span></a>
                        <a class="nav-link" href="index.php?controller=order&action=listOrder&status=cancelled"><i
                                class="fas fa-ban"></i> <span class="nav-text">Đã hủy</span></a>
                    </div>
                    <!-- Dropdown cho chế độ thu gọn (hover - hiện bên phải) -->
                    <div class="dropdown-collapsed">
                        <a class="dropdown-item-custom" href="index.php?controller=order&action=listOrder"><i
                                class="fas fa-circle"></i> Tất cả đơn</a>
                        <a class="dropdown-item-custom"
                            href="index.php?controller=order&action=listOrder&status=pending"><i
                                class="fas fa-clock"></i> Chờ xác nhận</a>
                        <a class="dropdown-item-custom"
                            href="index.php?controller=order&action=listOrder&status=confirmed"><i
                                class="fas fa-check-circle"></i> Đã xác nhận</a>
                        <a class="dropdown-item-custom"
                            href="index.php?controller=order&action=listOrder&status=shipping"><i
                                class="fas fa-shipping-fast"></i> Đang giao</a>
                        <a class="dropdown-item-custom"
                            href="index.php?controller=order&action=listOrder&status=completed"><i
                                class="fas fa-flag-checkered"></i> Hoàn thành</a>
                        <a class="dropdown-item-custom"
                            href="index.php?controller=order&action=listOrder&status=cancelled"><i
                                class="fas fa-ban"></i> Đã hủy</a>
                    </div>
                </div>

                <!-- Khuyến mãi dropdown -->
                <div class="nav-item">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fas fa-tags"></i>
                        <span class="nav-text">Khuyến mãi</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <div class="dropdown-default">
                        <a class="nav-link" href="index.php?controller=promotion&action=listAllProductPromotion"><i
                                class="fas fa-gift"></i> <span class="nav-text">Tất cả SPKM</span></a>
                        <a class="nav-link" href="index.php?controller=promotion&action=listPromotion"><i
                                class="fas fa-ticket"></i> <span class="nav-text">Code khuyến mãi</span></a>
                        <a class="nav-link" href="index.php?controller=promotion&action=listApplyProductPromotion"><i
                                class="fas fa-fire"></i> <span class="nav-text">Đang khuyến mãi</span></a>
                        <a class="nav-link" href="index.php?controller=promotion&action=listExpiredProductPromotion"><i
                                class="fas fa-hourglass-end"></i> <span class="nav-text">Hết hạn</span></a>
                        <a class="nav-link" href="index.php?controller=promotion&action=listInactiveProductPromotion"><i
                                class="fas fa-pause-circle"></i> <span class="nav-text">Tạm ngưng</span></a>
                        <a class="nav-link" href="index.php?controller=promotion&action=applyProductPromotion"><i
                                class="fas fa-plus-circle"></i> <span class="nav-text">Áp dụng KM</span></a>
                    </div>
                    <div class="dropdown-collapsed">
                        <a class="dropdown-item-custom"
                            href="index.php?controller=promotion&action=listAllProductPromotion"><i
                                class="fas fa-gift"></i> Tất cả SPKM</a>
                        <a class="dropdown-item-custom" href="index.php?controller=promotion&action=listPromotion"><i
                                class="fas fa-ticket"></i> Code khuyến mãi</a>
                        <a class="dropdown-item-custom"
                            href="index.php?controller=promotion&action=listApplyProductPromotion"><i
                                class="fas fa-fire"></i> Đang khuyến mãi</a>
                        <a class="dropdown-item-custom"
                            href="index.php?controller=promotion&action=listExpiredProductPromotion"><i
                                class="fas fa-hourglass-end"></i> Hết hạn</a>
                        <a class="dropdown-item-custom"
                            href="index.php?controller=promotion&action=listInactiveProductPromotion"><i
                                class="fas fa-pause-circle"></i> Tạm ngưng</a>
                        <a class="dropdown-item-custom"
                            href="index.php?controller=promotion&action=applyProductPromotion"><i
                                class="fas fa-plus-circle"></i> Áp dụng KM</a>
                    </div>
                </div>

                <a class="nav-link" href="#"><i class="fa-regular fa-message"></i> <span class="nav-text">Bình
                        luận</span></a>

                <!-- Tài khoản dropdown -->
                <div class="nav-item">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fas fa-user-shield"></i>
                        <span class="nav-text">Tài khoản</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <div class="dropdown-default">
                        <a class="nav-link" href="index.php?controller=accountAdmin&action=listAccountAdmin"><i
                                class="fas fa-crown"></i> <span class="nav-text">Quản trị viên</span></a>
                        <a class="nav-link" href="index.php?controller=accountCustomer&action=listAccountCustomer"><i
                                class="fas fa-users"></i> <span class="nav-text">Khách hàng</span></a>
                    </div>
                    <div class="dropdown-collapsed">
                        <a class="dropdown-item-custom"
                            href="index.php?controller=accountAdmin&action=listAccountAdmin"><i
                                class="fas fa-crown"></i> Quản trị viên</a>
                        <a class="dropdown-item-custom"
                            href="index.php?controller=accountCustomer&action=listAccountCustomer"><i
                                class="fas fa-users"></i> Khách hàng</a>
                    </div>
                </div>

                <a class="nav-link" href="#"><i class="fas fa-sliders-h"></i> <span class="nav-text">Cài đặt</span></a>
                <hr class="bg-light opacity-25">
                <a class="nav-link text-danger" href="../../../index.php"><i class="fas fa-sign-out-alt"></i> <span
                        class="nav-text">Đăng xuất</span></a>
            </nav>

        </div>
    </div>

    <!-- TOP BAR -->
    <nav class="navbar navbar-expand navbar-admin fixed-top">
        <div class="container-fluid">
            <button class="btn btn-glass" type="button" id="toggleSidebarBtnMobile">
                <i class="fas fa-bars"></i>
            </button>
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" style="color:#0f172a; gap: 12px;">
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
                        <li><a class="dropdown-item rounded-3" href="profile.php"><i class="fas fa-id-card me-2"></i>Hồ
                                sơ</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger rounded-3" href="../../../index.php"><i
                                    class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-content" id="mainContent">
        <?php
        if (isset($viewFile) && file_exists($viewFile)) {
            include $viewFile;
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    (function() {
        const sidebar = document.getElementById('adminSidebar');
        const toggleBtnDesktop = document.getElementById('toggleSidebarBtnDesktop');
        const toggleBtnMobile = document.getElementById('toggleSidebarBtnMobile');
        const closeBtnMobile = document.getElementById('closeSidebarBtnMobile');
        const BREAKPOINT = 768;

        function isMobile() {
            return window.innerWidth <= BREAKPOINT;
        }

        function saveSidebarState() {
            localStorage.setItem('adminSidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        function closeAllDropdowns(exceptItem = null) {
            document.querySelectorAll('.sidebar .nav-item.open, .sidebar .nav-item.show-flyout').forEach(item => {
                if (item !== exceptItem) {
                    item.classList.remove('open');
                    item.classList.remove('show-flyout');
                }
            });
        }

        function updateCollapsedDropdownPosition() {
            if (!sidebar || !sidebar.classList.contains('collapsed') || isMobile()) return;

            sidebar.querySelectorAll('.nav-item').forEach(item => {
                const dropdown = item.querySelector('.dropdown-collapsed');
                const link = item.querySelector('.nav-link');
                if (!dropdown || !link) return;

                const rect = link.getBoundingClientRect();
                dropdown.style.top = `${rect.top}px`;
                dropdown.style.left = `${rect.right + 10}px`;
            });
        }

        function toggleDesktopSidebar() {
            sidebar.classList.toggle('collapsed');
            closeAllDropdowns();
            saveSidebarState();
            requestAnimationFrame(updateCollapsedDropdownPosition);
        }

        function toggleMobileSidebar() {
            sidebar.classList.toggle('show-mobile');
            if (sidebar.classList.contains('show-mobile')) {
                sidebar.style.transform = 'translateX(0)';
            } else {
                sidebar.style.transform = 'translateX(-100%)';
            }
        }

        function handleSidebarToggle() {
            isMobile() ? toggleMobileSidebar() : toggleDesktopSidebar();
        }

        function bindDropdownEvents() {
            document.querySelectorAll('.sidebar .nav-item > .nav-link.nav-dropdown-toggle').forEach(toggle => {
                toggle.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const parentItem = this.closest('.nav-item');

                    if (isMobile()) {
                        const isOpen = parentItem.classList.contains('open');
                        closeAllDropdowns(parentItem);
                        parentItem.classList.toggle('open', !isOpen);
                        return;
                    }

                    if (sidebar.classList.contains('collapsed')) {
                        const isFlyoutOpen = parentItem.classList.contains('show-flyout');

                        document.querySelectorAll('.sidebar .nav-item.show-flyout').forEach(item => {
                            if (item !== parentItem) item.classList.remove('show-flyout');
                        });

                        parentItem.classList.toggle('show-flyout', !isFlyoutOpen);
                        updateCollapsedDropdownPosition();
                        return;
                    }

                    const isOpen = parentItem.classList.contains('open');
                    closeAllDropdowns(parentItem);
                    parentItem.classList.toggle('open', !isOpen);
                };
            });
        }

        function initSidebarState() {
            if (isMobile()) {
                sidebar.classList.remove('collapsed');
                sidebar.classList.remove('show-mobile');
                sidebar.style.transform = 'translateX(-100%)';
            } else {
                sidebar.style.transform = '';
                const saved = localStorage.getItem('adminSidebarCollapsed');
                sidebar.classList.toggle('collapsed', saved === 'true');
                requestAnimationFrame(updateCollapsedDropdownPosition);
            }
        }

        document.addEventListener('click', function(e) {
            // Đóng mobile sidebar khi click ra ngoài
            if (isMobile() && sidebar.classList.contains('show-mobile')) {
                if (!e.target.closest('.sidebar') && !e.target.closest('#toggleSidebarBtnMobile')) {
                    toggleMobileSidebar();
                }
            }
            if (!e.target.closest('.sidebar')) closeAllDropdowns();
        });

        if (toggleBtnDesktop) toggleBtnDesktop.addEventListener('click', handleSidebarToggle);
        if (toggleBtnMobile) toggleBtnMobile.addEventListener('click', handleSidebarToggle);
        if (closeBtnMobile) closeBtnMobile.addEventListener('click', toggleMobileSidebar);

        window.addEventListener('resize', initSidebarState);
        window.addEventListener('scroll', updateCollapsedDropdownPosition);
        window.addEventListener('resize', updateCollapsedDropdownPosition);

        bindDropdownEvents();
        initSidebarState();
    })();
    </script>
</body>

</html>
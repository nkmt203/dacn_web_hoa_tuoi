<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/admins/products/dashboard.css">
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="adminSidebar">
        <div class="text-center mb-4">
            <h5 class="text-white fw-bold">ADMIN</h5>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link active" href="index.php?controller=dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span class="nav-text">Trang chủ</span>
            </a>
            <a class="nav-link" href="index.php?controller=product&action=listProduct">
                <i class="fas fa-box"></i>
                <span class="nav-text">Sản phẩm</span>
            </a>
            <a class="nav-link" href="index.php?controller=category&action=listCategory">
                <i class="fa-solid fa-table-list"></i>
                <span class="nav-text">Danh mục</span>
            </a>

            <!-- Đơn hàng -->
            <div class="nav-item">
                <a class="nav-link dropdown-toggle" href="#">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="nav-text">Đơn hàng</span>
                </a>
                <div class="dropdown">
                    <a class="nav-link" href="index.php?controller=order&action=listOrder">Tất cả đơn</a>
                    <a class="nav-link" href="index.php?controller=order&action=listOrder&status=pending">Chờ xác nhận</a>
                    <a class="nav-link" href="index.php?controller=order&action=listOrder&status=confirmed">Đã xác nhận</a>
                    <a class="nav-link" href="index.php?controller=order&action=listOrder&status=shipping">Đang giao</a>
                    <a class="nav-link" href="index.php?controller=order&action=listOrder&status=cancelled">Đã hủy</a>
                    <a class="nav-link" href="index.php?controller=order&action=listOrder&status=completed">Hoàn thành</a>
                </div>
            </div>

            <a class="nav-link" href="#">
                <i class="fas fa-gift"></i>
                <span class="nav-text">Khuyến mãi</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fa-solid fa-comment"></i>
                <span class="nav-text">Bình luận</span>
            </a>

            <!-- Tài khoản -->
            <div class="nav-item">
                <a class="nav-link dropdown-toggle" href="#">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Tài khoản</span>
                </a>
                <div class="dropdown">
                    <a class="nav-link" href="index.php?controller=accountAdmin&action=listAccountAdmin">Admin</a>
                    <a class="nav-link" href="index.php?controller=accountCustomer&action=listAccountCustomer">Customer</a>
                </div>
            </div>

            <a class="nav-link" href="#">
                <i class="fas fa-cog"></i>
                <span class="nav-text">Cài đặt</span>
            </a>
            <hr class="bg-light opacity-25">
            <a class="nav-link text-danger" href="index.php?router=logout">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-text">Đăng xuất</span>
            </a>
        </nav>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-admin fixed-top" id="topNavbar">
        <div class="container-fluid">
            <button class="btn btn-primary me-3" type="button" onclick="document.getElementById('adminSidebar').classList.toggle('collapsed')">
                <i class="fas fa-bars"></i>
            </button>

            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-circle-user" style="margin-right: 7px;"></i>
                        <span class="d-none d-sm-inline fw-semibold">
                            <?php
                            if (isset($_SESSION['admin'])) {
                                echo htmlspecialchars($_SESSION['admin']['username']);
                            } else {
                                echo "Admin";
                            }
                            ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="index.php?controller=login&action=logout">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <?php
        if (isset($viewFile) && file_exists($viewFile))
            include $viewFile;
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script fix dropdown -->
    <script>
        document.querySelectorAll('.sidebar .nav-item > .nav-link.dropdown-toggle').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const parentItem = this.closest('.nav-item');

                // Đóng tất cả dropdown khác
                document.querySelectorAll('.sidebar .nav-item.open').forEach(item => {
                    if (item !== parentItem) {
                        item.classList.remove('open');
                    }
                });

                // Toggle dropdown hiện tại
                parentItem.classList.toggle('open');
            });
        });
    </script>
</body>
</html>

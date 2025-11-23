<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
    <!-- link css -->
    <link rel="stylesheet" href="../../../assets/css/admins/products/dashboard.css">
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-4">
            <h5 class="text-white fw-bold">ADMIN</h5>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link" href="index.php?controller=dashboard">
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
            <a class="nav-link" href="#">
                <i class="fas fa-shopping-cart"></i>
                <span class="nav-text">Đơn hàng</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fa-solid fa-dumpster-fire"></i>
                <span class="nav-text">Khuyến mãi</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fa-solid fa-comment"></i>
                <span class="nav-text">Bình luận</span>
            </a>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="this.parentElement.classList.toggle('open')">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Tài khoản</span>
                </a>
                <div class="dropdown">
                    <a class="nav-link" href="index.php?controller=accountAdmin&action=listAccountAdmin">Admin</a>
                    <a class="nav-link" href="index.php?controller=accountCustomer&action=listAccountCustomer">Customer</a>
                </div>
            </li>

            <a class="nav-link" href="#">
                <i class="fas fa-cog"></i>
                <span class="nav-text">Cài đặt</span>
            </a>
            <hr class="bg-light opacity-25">
            <a class="nav-link text-danger" href="#">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-text">Đăng xuất</span>
            </a>
        </nav>
    </div>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand navbar-admin fixed-top">
        <div class="container-fluid">
            <button class="btn btn-primary d-lg-none me-3" onclick="document.querySelector('.sidebar').classList.toggle('collapsed')">
                <i class="fas fa-bars"></i>
            </button>
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="https://via.placeholder.com/40" alt="Admin" class="rounded-circle me-2" width="40">
                        <span class="d-none d-sm-inline fw-semibold">Admin User</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="#">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content pt-5">
        <?php
        if (isset($viewFile) && file_exists($viewFile))
            include $viewFile;
        ?>
    </div>
</body>

</html>
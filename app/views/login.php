<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-container {
            max-width: 420px;
            margin: 0 auto;
            padding: 2rem;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            background: linear-gradient(45deg, #4e54c8, #8f94fb);
            color: white;
            text-align: center;
            padding: 1.5rem;
        }

        .nav-tabs .nav-link {
            border-radius: 0.5rem 0.5rem 0 0;
            font-weight: 600;
        }

        .nav-tabs .nav-link.active {
            background-color: #fff;
            color: #4e54c8;
            border-bottom: none;
        }

        .btn-login {
            background: linear-gradient(45deg, #4e54c8, #8f94fb);
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-weight: 600;
        }

        .btn-admin {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
        }

        .btn-login:hover,
        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Đăng Nhập Hệ Thống</h3>
                <?php
                require_once __DIR__ . '/../../helpers/message_helper.php';
                MessageHelper::logMessage();
                ?>
            </div>

            <div class="card-body p-4">
                <!-- Tabs chọn loại tài khoản -->
                <ul class="nav nav-tabs mb-4" id="loginTab" role="tablist">
                    <li class="nav-item flex-fill">
                        <button class="nav-link active w-100" id="customer-tab" data-bs-toggle="tab" data-bs-target="#customer">
                            <i class="bi bi-person-circle"></i> Customer
                        </button>
                    </li>
                    <li class="nav-item flex-fill">
                        <button class="nav-link w-100" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin">
                            <i class="bi bi-person-fill-gear"></i> Admin
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- ==================== CUSTOMER ==================== -->
                    <div class="tab-pane fade show active" id="customer">
                        <form action="" method="POST">
                            <input type="hidden" name="role" value="customer">
                            <div class="mb-3">
                                <label class="form-label">Tên đăng nhập</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" name="username" placeholder="Nhập tên đăng nhập" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" name="password" id="custPass" placeholder="Nhập mật khẩu" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('custPass', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember">
                                    <label class="form-check-label" for="remember">Nhớ mật khẩu</label>
                                </div>
                                <a href="forgot_password.php" class="small text-decoration-none">Quên mật khẩu?</a>
                            </div>

                            <button type="submit" name="btnLoginCustomer" class="btn btn-primary btn-login w-100 text-white">
                                <i class="bi bi-box-arrow-in-right"></i> Đăng nhập Customer
                            </button>
                        </form>

                        <hr class="my-4">
                        <p class="text-center mb-0">
                            Chưa có tài khoản?
                            <a href="register.php" class="fw-bold text-decoration-none">Đăng ký ngay</a>
                        </p>
                    </div>

                    <!-- ==================== ADMIN (chỉ đăng nhập) ==================== -->
                    <div class="tab-pane fade" id="admin">
                        <form action="" method="POST">
                            <input type="hidden" name="role" value="admin">

                            <div class="mb-3">
                                <label class="form-label">Tên đăng nhập Admin</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                    <input type="text" class="form-control" name="username" placeholder="Nhập tên đăng nhập" required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                    <input type="password" class="form-control" name="password" id="adminPass" placeholder="Nhập mật khẩu" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('adminPass', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Nút đăng nhập Admin (màu đỏ để phân biệt) -->
                            <button type="submit" name="btnLoginAdmin" class="btn btn-danger btn-admin btn-login w-100 text-white">
                                <i class="bi bi-shield-check"></i> Đăng nhập Admin
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePass(id, btn) {
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
</body>

</html>
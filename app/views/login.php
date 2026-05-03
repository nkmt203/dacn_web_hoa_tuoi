<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập - Bloom & Blossom</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --floral-gold: #d4a373;
            --floral-dark: #1d2d22;
            --floral-bg: #f8f9fa;
        }

        body {
            font-family: 'Jost', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), 
                        url('https://images.unsplash.com/photo-1490750967868-58a4b9b7e902?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat fixed;
            margin: 0;
            padding: 20px;
        }

        /* Card Form nằm giữa */
        .login-card {
            width: 100%;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 24px;
            padding: 3.5rem 3rem 3rem 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative; /* Quan trọng để đặt nút quay lại bên trong */
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Nút quay lại nằm GỐC TRÊN BÊN TRÁI FORM */
        .btn-back-inner {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #888;
            text-decoration: none;
            font-size: 1.2rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-back-inner:hover {
            background: #f0f0f0;
            color: var(--floral-gold);
            transform: scale(1.1);
        }

        .brand-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.3rem;
            color: var(--floral-dark);
            text-align: center;
            margin-bottom: 0.5rem;
        }

        /* Tabs Modern */
        .nav-tabs {
            border: none;
            background: #f0f0f0;
            padding: 5px;
            border-radius: 14px;
            margin-bottom: 2rem;
        }

        .nav-tabs .nav-link {
            border: none !important;
            border-radius: 10px !important;
            color: #777;
            font-weight: 600;
            padding: 10px;
            transition: 0.3s;
        }

        .nav-tabs .nav-link.active {
            background: white !important;
            color: var(--floral-gold) !important;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        /* Form Controls */
        .form-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .input-group {
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
            transition: 0.3s;
            background: #fcfcfc;
            margin-bottom: 1.2rem;
        }

        .input-group:focus-within {
            border-color: var(--floral-gold);
            background: white;
            box-shadow: 0 0 0 4px rgba(212, 163, 115, 0.1);
        }

        .input-group-text {
            background: transparent;
            border: none;
            color: var(--floral-gold);
            padding-left: 15px;
        }

        .form-control {
            border: none;
            padding: 0.8rem 0.5rem;
            font-size: 0.95rem;
        }

        .form-control:focus { box-shadow: none; }

        /* Button Đăng nhập */
        .btn-login {
            background: var(--floral-dark);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
            margin-top: 0.5rem;
            transition: 0.3s;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background: var(--floral-gold);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(212, 163, 115, 0.2);
        }

        .register-link {
            color: var(--floral-gold);
            text-decoration: none;
            font-weight: 600;
        }

        .register-link:hover { text-decoration: underline; }
    </style>
</head>

<body>

    <div class="login-card">
        <a href="index.php" class="btn-back-inner" title="Quay lại trang chủ">
            <i class="bi bi-arrow-left"></i>
        </a>

        <div class="text-center mb-4">
            <h2 class="brand-title">Bloom & Blossom</h2>
            <p class="text-muted small">Hương sắc cho cuộc sống thêm ngọt ngào</p>
            <?php
            require_once __DIR__ . '/../../helpers/message_helper.php';
            MessageHelper::logMessage();
            ?>
        </div>

        <ul class="nav nav-tabs nav-fill" id="loginTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="customer-tab" data-bs-toggle="tab" data-bs-target="#customer">
                    Khách hàng
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin">
                    Quản trị
                </button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="customer">
                <form action="" method="POST">
                    <input type="hidden" name="role" value="customer">
                    
                    <div class="mb-2">
                        <label class="form-label">Tên tài khoản</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" required>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" name="password" id="custPass" placeholder="••••••••" required>
                            <button class="btn btn-link text-muted pe-3" type="button" onclick="togglePass('custPass', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label small text-muted" for="remember">Ghi nhớ</label>
                        </div>
                        <a href="forgot_password.php" class="small text-muted text-decoration-none">Quên mật khẩu?</a>
                    </div>

                    <button type="submit" name="btnLoginCustomer" class="btn btn-login">ĐĂNG NHẬP</button>
                </form>
                
                <div class="text-center mt-4">
                    <p class="small text-muted mb-0">Chưa có tài khoản? 
                        <a href="index.php?router=register" class="register-link">Đăng ký ngay</a>
                    </p>
                </div>
            </div>

            <div class="tab-pane fade" id="admin">
                <form action="" method="POST">
                    <input type="hidden" name="role" value="admin">
                    
                    <div class="mb-3">
                        <label class="form-label">Mã nhân viên</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Admin ID" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Mật khẩu hệ thống</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" name="password" id="adminPass" placeholder="••••••••" required>
                            <button class="btn btn-link text-muted pe-3" type="button" onclick="togglePass('adminPass', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" name="btnLoginAdmin" class="btn btn-login">XÁC THỰC ADMIN</button>
                </form>
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
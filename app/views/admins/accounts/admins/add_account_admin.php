<?php
require_once __DIR__ . '/../../../../models/account_admin_model.php';
require_once __DIR__ . '/../../../../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin thêm tài khoản</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="p-3">
    <div class="container d-flex justify-content-center">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <form action="index.php?controller=accountAdmin&action=addAccountAdmin" method="post" enctype="multipart/form-data"
            class="p-4 border rounded" style="width: 450px; background-color: #f9f9f9;">
            <h3 class="text-center mb-4 fw-bold">Thêm tài khoản</h3>

            <label class="fw-bold" for="username">Tên tài khoản:</label>
            <input type="text" id="username" name="username" class="form-control mb-3" minlength="3" maxlength="10" placeholder="VD: admin001" required> <br>

            <label class="fw-bold" for="">Email:</label>
            <input type="email" id="email" name="email" class="form-control mb-3" required> <br>

            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Mật khẩu:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <span class="input-group-text" style="cursor:pointer;" onclick="togglePassword()">
                        <i class="fa-solid fa-eye" id="eyeIcon"></i>
                    </span>
                </div>
            </div>


            <label class="fw-bold" for="">Tên quản trị:</label>
            <input type="text" id="full_name" name="full_name" class="form-control mb-3" required> <br>

            <label class="fw-bold" for="">Số điện thoại:</label>
            <input type="tel" pattern="[0-9]{10,15}" id="phone" name="phone" class="form-control mb-3" placeholder="VD: 0377931295" required> <br>

            <input type="submit" value="Tạo" name="btnAddAccountAdmin" class="btn btn-primary w-100">

        </form>
    </div>
</body>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>

</html>
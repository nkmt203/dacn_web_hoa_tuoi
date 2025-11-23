<?php
// code test data

require_once __DIR__ . '/../../../../models/account_admin_model.php';
require_once __DIR__ . '/../../../../../config/config.php';

$accAdminModel = new AccountAdminModel();
$listAccAdmin = $accAdminModel->getAllAccountAdmin();

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách Tài khoản Admin</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .col-password {
            max-width: 350px;
            /* giới hạn chiều rộng */
            word-wrap: break-word;
            /* tự xuống dòng khi dài */
            white-space: normal;
            /* cho phép xuống dòng */
        }
    </style>
</head>

<body class="p-1 m-1">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold">Danh sách Tài khoản Admin</h2>
        <!-- log thông báo -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <!-- log thông báo -->
        <a href="index.php?controller=accountAdmin&action=addAccountAdmin" class="btn btn-primary mb-3">+ Tạo tài khoản</a>
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Tên tài khoản</th>
                    <th>Email</th>
                    <th class="col-password">Mật khẩu</th>
                    <th>Tên quản trị</th>
                    <th>Số điện thoại</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listAccAdmin as $acc): ?>
                    <tr>
                        <td style="font-weight: bold;"><?= $acc['admin_id'] ?></td>
                        <td><?= $acc['username'] ?></td>
                        <td><?= $acc['email'] ?></td>
                        <td class="col-password"><?= $acc['password'] ?></td>
                        <td><?= $acc['full_name'] ?></td>
                        <td><?= $acc['phone'] ?></td>
                        <td><?= $acc['created_at'] ?></td>
                        <td><?= $acc['updated_at'] ?></td>
                        <td class="align-middle text-center">
                            <div class="d-inline-flex justify-content-center align-items-center gap-2">
                                <a href="index.php?controller=accountAdmin&action=updateAccountAdmin&admin_id=<?= $acc['admin_id'] ?>"
                                    onclick="return confirm('Bạn có chắc muốn cập nhật')"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i></a>|
                                <a href="index.php?controller=accountAdmin&action=deleteAccountAdmin&admin_id=<?= $acc['admin_id'] ?>"
                                    onclick="return confirm('Bạn có chắc muốn xóa')"
                                    class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
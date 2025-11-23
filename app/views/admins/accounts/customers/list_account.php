<?php
// code test data

require_once __DIR__ . '/../../../../models/account_customer_model.php';
require_once __DIR__ . '/../../../../../config/config.php';


$accCustomerModel = new AccountCustomerModel();
$listAccCustomer = $accCustomerModel->getAllAccountCustomer();

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
        <h2 class="mb-4 text-center fw-bold">Danh sách Tài khoản khách hàng</h2>
        <?php
        require_once __DIR__ . '/../../../../../helpers/message_helper.php';
        MessageHelper::logMessage();
        ?>
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Tên tài khoản</th>
                    <th>Email</th>
                    <th class="col-password">Mật khẩu</th>
                    <th>Tên quản trị</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listAccCustomer as $acc): ?>
                    <tr>
                        <td style="font-weight: bold;"><?= $acc['customer_id'] ?></td>
                        <td><?= $acc['username'] ?></td>
                        <td><?= $acc['email'] ?></td>
                        <td class="col-password"><?= $acc['password'] ?></td>
                        <td><?= $acc['full_name'] ?></td>
                        <td><?= $acc['phone'] ?></td>
                        <td><?= $acc['address'] ?></td>
                        <td><?= $acc['created_at'] ?></td>
                        <td><?= $acc['updated_at'] ?></td>
                        <td class="align-middle text-center">
                            <div class="d-inline-flex justify-content-center align-items-center gap-2">
                                <a href="index.php?controller=accountCustomer&action=deleteAccountCustomer&customer_id=<?= $acc['customer_id'] ?>"
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
<?php
require_once __DIR__.'/../../../config/config.php';

session_start();
$admin_id = $_SESSION['admin_id'] ?? 1;

$pdo = pdo_connect();
$stmt = $pdo->prepare("SELECT * FROM admins WHERE admin_id = ?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
    die("Không tìm thấy admin!");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Profile Admin</title>
  <!-- Bootstrap 5 CSS + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-0 rounded-3">
          <div class="card-header bg-gradient bg-primary text-white text-center py-4">
            <img src="https://via.placeholder.com/100" class="rounded-circle border border-3 border-white mb-3" alt="Avatar">
            <h3 class="mb-0"><?= htmlspecialchars($admin['full_name']) ?></h3>
            <small class="text-light">Admin Profile</small>
          </div>
          <div class="card-body p-4">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <i class="bi bi-person-circle me-2 text-primary"></i>
                <strong>Username:</strong> <?= htmlspecialchars($admin['username']) ?>
              </li>
              <li class="list-group-item">
                <i class="bi bi-envelope-fill me-2 text-primary"></i>
                <strong>Email:</strong> <?= htmlspecialchars($admin['email']) ?>
              </li>
              <li class="list-group-item">
                <i class="bi bi-telephone-fill me-2 text-primary"></i>
                <strong>Số điện thoại:</strong> <?= htmlspecialchars($admin['phone']) ?>
              </li>
              <li class="list-group-item">
                <i class="bi bi-calendar-check me-2 text-success"></i>
                <strong>Ngày tạo:</strong> <?= $admin['created_at'] ?>
              </li>
              <li class="list-group-item">
                <i class="bi bi-clock-history me-2 text-warning"></i>
                <strong>Cập nhật lần cuối:</strong> <?= $admin['updated_at'] ?>
              </li>
            </ul>
          </div>
          <div class="card-footer text-center bg-light">
            <a href="edit_profile.php" class="btn btn-warning px-4">
              <i class="bi bi-pencil-square me-1"></i> Chỉnh sửa
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

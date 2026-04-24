<?php
// code test data

// require_once __DIR__ . '/../../../models/product_model.php';
// require_once __DIR__ . '/../../../../config/config.php';
// $product = new ProductModel();
// $listProduct = $product->getAllProduct();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Danh sách sản phẩm</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 0;
        }

        .container-custom {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .header-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-custom h2 {
            margin: 0;
            font-weight: 600;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: transform 0.2s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .table-custom {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table-custom thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .table-custom thead th {
            font-weight: 600;
            padding: 15px;
            border: none;
        }

        .table-custom tbody tr:hover {
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .table-custom tbody td {
            padding: 12px;
            vertical-align: middle;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.5);
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .description-text {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .btn-action {
            padding: 6px 12px;
            border-radius: 8px;
            margin: 0 3px;
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }

        .pagination-custom .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            color: white;
        }

        .pagination-custom .page-link {
            color: #667eea;
            border-radius: 8px;
            margin: 0 3px;
        }

        .pagination-custom .page-link:hover {
            background: #667eea;
            color: white;
        }

        /* Scrollbar tùy chỉnh */
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container container-custom">
        <!-- Header -->
        <div class="header-custom">
            <h2>
                <i class="fas fa-boxes me-2"></i>Danh sách sản phẩm
            </h2>
            <a href="index.php?controller=product&action=addProduct" class="btn btn-primary-custom">
                <i class="fas fa-plus-circle me-1"></i>Thêm mới sản phẩm
            </a>
        </div>

        <!-- Message -->
        <?php
        require_once __DIR__ . '/../../../../helpers/message_helper.php';
        MessageHelper::logMessage();
        ?>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Mô tả</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th>Danh mục</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listProduct as $p): ?>
                        <tr>
                            <td>
                                <span class="fw-bold">#<?= $p['product_id'] ?></span>
                            </td>
                            <td class="fw-bold"><?= htmlspecialchars($p['product_name']) ?></td>
                            <td class="text-danger fw-bold"><?= number_format($p['price'], 0, ',', '.') ?>đ</td>
                            <td>
                                <div class="description-text" title="<?= htmlspecialchars($p['description']) ?>">
                                    <?= htmlspecialchars($p['description']) ?>
                                </div>
                            </td>
                            <td>
                                <?php if (!empty($p['image_url'])): ?>
                                    <img src="../../../../uploads/<?= $p['image_url'] ?>"
                                        alt="<?= $p['product_name'] ?>"
                                        class="product-image">
                                <?php else: ?>
                                    <span class="text-muted">Chưa có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="fw-bold"><?= $p['stock_quantity'] ?></span>
                            </td>
                            <td>
                                <?php
                                switch ($p['status']) {
                                    case 'available':
                                        echo "<span class='badge bg-success' style='padding: 8px 15px; min-width: 110px; display: inline-block;'>
                    <i class='fas fa-check-circle me-1'></i>Còn hàng
                  </span>";
                                        break;
                                    case 'out_of_stock':
                                        echo "<span class='badge bg-warning text-dark' style='padding: 8px 15px; min-width: 110px; display: inline-block;'>
                    <i class='fas fa-clock me-1'></i>Tạm hết
                  </span>";
                                        break;
                                    case 'discontinued':
                                        echo "<span class='badge bg-danger' style='padding: 8px 15px; min-width: 110px; display: inline-block;'>
                    <i class='fas fa-ban me-1'></i>Ngừng KD
                  </span>";
                                        break;
                                    default:
                                        echo "<span class='badge bg-secondary' style='padding: 8px 15px; min-width: 110px; display: inline-block;'>
                    <i class='fas fa-question me-1'></i>Lỗi
                  </span>";
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    <i class="fas fa-folder me-1"></i><?= htmlspecialchars($p['category_name']) ?>
                                </span>
                            </td>
                            <td>
                                <small><?= date('d/m/Y H:i', strtotime($p['created_at'])) ?></small>
                            </td>
                            <td>
                                <small><?= date('d/m/Y H:i', strtotime($p['updated_at'])) ?></small>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="index.php?controller=product&action=updateProduct&product_id=<?= $p['product_id'] ?>"
                                        onclick="return confirm('Bạn có chắc muốn cập nhật sản phẩm này?')"
                                        class="btn btn-warning btn-action" title="Cập nhật">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="index.php?controller=product&action=deleteProduct&product_id=<?= $p['product_id'] ?>"
                                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này? Hành động này không thể hoàn tác!')"
                                        class="btn btn-danger btn-action" title="Xóa">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($listProduct)): ?>
                        <tr>
                            <td colspan="11" class="text-center py-5">
                                <i class="fas fa-box-open fa-3x text-muted mb-3 d-block"></i>
                                <span class="text-muted">Chưa có sản phẩm nào. Hãy thêm sản phẩm mới!</span>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- PHÂN TRANG -->
        <?php if (isset($totalPages) && $totalPages > 1): ?>
            <nav class="mt-4">
                <ul class="pagination pagination-custom justify-content-center">
                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="index.php?controller=product&action=listProduct&page=<?= $page - 1 ?>">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="index.php?controller=product&action=listProduct&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="index.php?controller=product&action=listProduct&page=<?= $page + 1 ?>">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
        <!-- END PHÂN TRANG -->
    </div>
</body>

</html>
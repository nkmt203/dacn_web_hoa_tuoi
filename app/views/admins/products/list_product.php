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
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="../../../../assets/css/admins/products/list_product.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <h2>Danh sách sản phẩm</h2>
    <a href="index.php?controller=product&action=addProduct">Thêm sản phẩm</a>
    <table>
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
                    <td><?= $p['product_id'] ?></td>
                    <td><?= $p['product_name'] ?></td>
                    <td><?= number_format($p['price'], 0, '.', '.') ?>đ</td>
                    <td><?= $p['description'] ?></td>
                    <td>
                        <img src="../../../../uploads/<?= $p['image_url'] ?>" alt="#">
                    </td>
                    <td><?= $p['stock_quantity'] ?></td>
                    <?php
                    switch ($p['status']) {
                        case 'available':
                            echo " <td>Còn hàng</td>";
                            break;
                        case 'out_of_stock':
                            echo " <td>Tạm hết hàng</td>";
                            break;
                        case 'discontinued':
                            echo " <td>Ngừng kinh doanh</td>";
                            break;
                        default:
                            echo "<td>Lỗi trạng thái</td>";
                            break;
                    }
                    ?>
                    <td><?= $p['category_name'] ?></td>
                    <td><?= $p['created_at'] ?></td>
                    <td><?= $p['updated_at'] ?></td>
                    <td>
                        <a href="#">
                            <i class="fa-solid fa-pen-to-square"></i></a> /
                        <a href="index.php?controller=product&action=deleteProduct&product_id=<?= $p['product_id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa')">
                            <i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
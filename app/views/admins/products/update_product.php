<?php
require_once __DIR__ . '/../../../models/category_model.php';
require_once __DIR__ . '/../../../models/product_model.php';
require_once __DIR__ . '/../../../../config/config.php';
$categoryModel = new CategoryModel();
$listCategory = $categoryModel->getAllCategory();

$productModel = new ProductModel();
$listEnumStatus = $productModel->getValueEnumStatus();

$product_id = $_GET['product_id'];
$oneProduct = $productModel->getByIdProduct($product_id);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin thêm sản phẩm</title>
    <script src="../../../../assets/js/view_image.js"></script>

    <link rel="stylesheet" href="../../../../assets/css/admins/products/add_product.css">
</head>

<body>
    <form action="index.php?controller=product&action=updateProduct&product_id=<?= $oneProduct['product_id'] ?>" method="post" enctype="multipart/form-data">
        <label for="product_id">Mã sản phẩm: <?= $oneProduct['product_id'] ?></label>
        <label for="product_name">Tên sản phẩm:</label>
        <input type="text" id="product_name" name="product_name" value="<?= $oneProduct['product_name'] ?>" required> <br>

        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" value="<?= $oneProduct['price'] ?>" required> <br>

        <label for="description">Mô tả:</label>
        <textarea name="description" id="description"><?= $oneProduct['description'] ?></textarea> <br>

        <label for="image_url">Hình ảnh</label>
        <input type="file" id="image_url" name="image_url" onchange="ViewImage(event)"><br>
        <img src="../../../../uploads/<?= $oneProduct['image_url'] ?>" alt="" id="preview" style="width: 250px;"><br>

        <label for="stock_quantity">Số lượng</label>
        <input type="number" id="stock_quantity" name="stock_quantity" value="<?= $oneProduct['stock_quantity'] ?>" required><br>


        <label for="status">Trạng thái</label>
        <select name="status" id="status">
            <option value="">--Trạng thái--</option>
            <?php foreach ($listEnumStatus as $status): ?>
                <option value="<?= $status ?>" <?= ($status == $oneProduct['status']) ? 'selected' : '' ?>>
                    <?php
                    if ($status == 'available')
                        echo "Còn hàng (" . $status . ")";
                    else if ($status == 'out_of_stock')
                        echo "Tạm hết (" . $status . ")";
                    else if ($status == 'discontinued')
                        echo "Ngừng kinh doanh (" . $status . ") ";
                    ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="">Danh mục:</label>
        <select name="category_id" id="category_id">
            <option value="">--Chọn danh mục--</option>
            <?php foreach ($listCategory as $c): ?>
                <option value=" <?= $c['category_id'] ?> " <?= ($c['category_id'] == $oneProduct['category_id']) ? 'selected' : '' ?>>
                    <?= $c['category_name'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <input type="submit" value="Cập nhật" name="btnUpdateProduct">
    </form>
</body>

</html>
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
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        .form-container {
            max-width: 650px;
            margin: 40px auto;
        }

        textarea {
            height: 240px;
        }

        #preview {
            display: block;
            margin-top: 8px;
        }
        label {
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container form-container">
        <div class="card shadow p-4 rounded-3">
            <h3 class="text-center mb-4 fw-bold">Cập nhật sản phẩm</h3>
            <form action="index.php?controller=product&action=updateProduct&product_id=<?= $oneProduct['product_id'] ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label" for="product_id">Mã sản phẩm: #<?= $oneProduct['product_id'] ?></label>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="product_name">Tên sản phẩm:</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $oneProduct['product_name'] ?>" required> <br>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="price">Giá:</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?= $oneProduct['price'] ?>" required> <br>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="description">Mô tả:</label>
                    <textarea class="form-control" name="description" id="description"><?= $oneProduct['description'] ?></textarea> <br>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="image_url">Hình ảnh:</label>
                    <input type="file" id="image_url" class="form-control" name="image_url" onchange="ViewImage(event)"><br>
                    <img src="../../../../uploads/<?= $oneProduct['image_url'] ?>" alt="" id="preview" class="rounded" style="width: 250px;"><br>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="stock_quantity">Số lượng:</label>
                    <input class="form-control" type="number" id="stock_quantity" name="stock_quantity" value="<?= $oneProduct['stock_quantity'] ?>" required><br>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="status">Trạng thái:</label>
                    <select class="form-select" name="status" id="status">
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
                </div>

                <div class="mb-3">
                    <label class="form-label" for="">Danh mục:</label>
                    <select class="form-select" name="category_id" id="category_id">
                        <option value="">--Chọn danh mục--</option>
                        <?php foreach ($listCategory as $c): ?>
                            <option value=" <?= $c['category_id'] ?> " <?= ($c['category_id'] == $oneProduct['category_id']) ? 'selected' : '' ?>>
                                <?= $c['category_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>
                </div>
                <input type="submit" value="Cập nhật" name="btnUpdateProduct" class="btn btn-warning w-100 fw-bold">
            </form>
        </div>
    </div>
</body>

</html>
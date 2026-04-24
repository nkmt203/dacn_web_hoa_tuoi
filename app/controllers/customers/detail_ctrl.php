<?php
require_once __DIR__ . '/../../models/product_model.php';
require_once __DIR__ . '/../../models/category_model.php';
require_once __DIR__ . '/../../models/promotion_model.php';

class DetailController
{
    public function index()
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $promotionModel = new PromotionModel();

        $productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if (!$productId) {
            header("Location: index.php?router=customers");
            exit;
        }

        $product = $productModel->getByIdProduct($productId);

        if (!$product) {
            header("Location: index.php?router=customers");
            exit;
        }

        $category = $categoryModel->getByIdCategory($product['category_id']);

        // Add promotion data
        $promotions = $promotionModel->getProductPromotions([$productId]);
        if (!empty($promotions)) {
            $product['promotion'] = $promotions[0];
            if ($promotions[0]['discount_type'] === 'percentage') {
                $product['discounted_price'] = $product['price'] * (1 - $promotions[0]['discount_value'] / 100);
            } else {
                $product['discounted_price'] = $product['price'] - $promotions[0]['discount_value'];
            }
        }

        require_once __DIR__ . '/../../views/customers/detail.php';
    }
}

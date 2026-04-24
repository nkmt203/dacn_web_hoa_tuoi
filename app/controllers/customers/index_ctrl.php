<?php
require_once __DIR__ . '/../../models/product_model.php';
require_once __DIR__ . '/../../models/category_model.php';
require_once __DIR__ . '/../../models/promotion_model.php';

class IndexController
{
    public function index()
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $promotionModel = new PromotionModel();

        // Lọc
        $selectedCategories = isset($_GET['categories']) ? $_GET['categories'] : [];
        $selectedPriceRange = isset($_GET['price_range']) ? explode('-', $_GET['price_range']) : null;

        // Phân trang
        $itemsPerPage = 6;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Lấy dữ liệu
        $products = $productModel->getProductsForCustomerPagination($itemsPerPage, $offset, $selectedCategories, $selectedPriceRange);
        $totalProducts = $productModel->countProductsForCustomer($selectedCategories, $selectedPriceRange);
        $totalPages = ceil($totalProducts / $itemsPerPage);

        // Lấy danh mục chỉ những danh mục có sản phẩm
        $allCategories = $categoryModel->getAllCategory();
        $activeProducts = $productModel->getAllProductForCustomer();
        $activeCategories = array_unique(array_column($activeProducts, 'category_id'));
        $categories = array_filter($allCategories, function ($cat) use ($activeCategories) {
            return in_array($cat['category_id'], $activeCategories);
        });

        // Tính số lượng sản phẩm cho mỗi danh mục
        $categoryCounts = [];
        foreach ($activeProducts as $product) {
            $catId = $product['category_id'];
            $categoryCounts[$catId] = ($categoryCounts[$catId] ?? 0) + 1;
        }

        // Lấy min/max giá từ sản phẩm
        $prices = array_column($activeProducts, 'price');
        $minPrice = !empty($prices) ? min($prices) : 0;
        $maxPrice = !empty($prices) ? max($prices) : 0;

        require_once __DIR__ . '/../../views/customers/dashboard.php';
    }
}

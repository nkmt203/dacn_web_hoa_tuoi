<?php
/**
 * @var array  $listProduct  Danh sách sản phẩm từ controller
 * @var int    $page         Trang hiện tại
 * @var int    $totalPages   Tổng số trang
 */

// code test data - giữ nguyên

// require_once __DIR__ . '/../../../models/product_model.php';
// require_once __DIR__ . '/../../../../config/config.php';
// $product = new ProductModel();
// $listProduct = $product->getAllProduct();

?>

<!-- ========== NỘI DUNG CHÍNH CHO DASHBOARD ========== -->
<div class="container-fluid px-0">
    <!-- Header hiện đại -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold" style="letter-spacing: -0.02em;">
                <i class="fas fa-cubes me-2 text-primary"></i>Quản lý sản phẩm
            </h2>
            <p class="text-muted mb-0">Quản lý toàn bộ danh mục & tồn kho thông minh</p>
        </div>
        <a href="index.php?controller=product&action=addProduct" class="btn btn-primary-gradient mt-2 mt-sm-0">
            <i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm
        </a>
    </div>

    <!-- Message Helper -->
    <?php
    if (file_exists(__DIR__ . '/../../../../helpers/message_helper.php')) {
        require_once __DIR__ . '/../../../../helpers/message_helper.php';
        MessageHelper::logMessage();
    }
    ?>

    <!-- Thanh tìm kiếm & lọc -->
    <div class="filter-bar-modern mb-4">
        <div class="search-group">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm sản phẩm, mã ID..."
                autocomplete="off">
        </div>
        <div class="filter-group">
            <select id="statusFilter" class="form-select filter-select">
                <option value="">⚡ Tất cả trạng thái</option>
                <option value="available">✅ Còn hàng</option>
                <option value="out_of_stock">⏳ Tạm hết</option>
                <option value="discontinued">❌ Ngừng KD</option>
            </select>
            <button id="resetFilterBtn" class="btn btn-secondary">
                <i class="fas fa-undo-alt me-1"></i>Reset
            </button>
        </div>
    </div>

    <!-- ========== TABLE VIEW (Desktop) ========== -->
    <div class="table-responsive-modern" id="tableView">
        <table class="table-modern" id="productTable">
            <thead>
                <tr>
                    <th style="width: 70px">Mã SP</th>
                    <th style="width: 100px">Hình ảnh</th>
                    <th style="width: 180px">Tên sản phẩm</th>
                    <th style="width: 140px">Danh mục</th>
                    <th style="width: 130px">Giá</th>
                    <th style="width: 90px">SL tồn</th>
                    <th style="width: 120px">Trạng thái</th>
                    <th style="width: 100px">Hành động</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php if (!empty($listProduct)): ?>
                <?php foreach ($listProduct as $p): ?>
                <tr data-status="<?= $p['status'] ?>"
                    data-name="<?= strtolower(htmlspecialchars($p['product_name'])) ?>"
                    data-id="<?= $p['product_id'] ?>">
                    <td class="text-primary fw-bold">#<?= $p['product_id'] ?></td>
                    <td>
                        <?php if (!empty($p['image_url'])): ?>
                        <img src="../../../../uploads/<?= $p['image_url'] ?>" alt="<?= $p['product_name'] ?>"
                            class="product-img">
                        <?php else: ?>
                        <div class="no-image-placeholder">
                            <i class="fas fa-image"></i>
                        </div>
                        <?php endif; ?>
                    </td>
                    <td class="fw-semibold"><?= htmlspecialchars($p['product_name']) ?></td>

                    <td>
                        <span class="badge-category">
                            <i class="fas fa-folder me-1"></i><?= htmlspecialchars($p['category_name']) ?>
                        </span>
                    </td>
                    <td class="fw-bold">
                        <?php if (isset($p['discounted_price'])): ?>
                        <span class="text-danger"><?= number_format($p['discounted_price'], 0, ',', '.') ?>₫</span><br>
                        <small
                            class="text-muted text-decoration-line-through"><?= number_format($p['price'], 0, ',', '.') ?>₫</small>
                        <?php else: ?>
                        <span class="text-success"><?= number_format($p['price'], 0, ',', '.') ?>₫</span>
                        <?php endif; ?>
                    </td>
                    <td><?= number_format($p['stock_quantity']) ?></td>
                    <td>
                        <?php
                                $statusClass = '';
                                $statusIcon = '';
                                $statusText = '';
                                switch ($p['status']) {
                                    case 'available':
                                        $statusClass = 'badge-available';
                                        $statusIcon = 'fa-check-circle';
                                        $statusText = 'Còn hàng';
                                        break;
                                    case 'out_of_stock':
                                        $statusClass = 'badge-outstock';
                                        $statusIcon = 'fa-clock';
                                        $statusText = 'Tạm hết';
                                        break;
                                    case 'discontinued':
                                        $statusClass = 'badge-discontinued';
                                        $statusIcon = 'fa-ban';
                                        $statusText = 'Ngừng KD';
                                        break;
                                    default:
                                        $statusClass = 'badge-available';
                                        $statusIcon = 'fa-question';
                                        $statusText = 'Khác';
                                }
                                ?>
                        <span class="badge-status <?= $statusClass ?>">
                            <i class="fas <?= $statusIcon ?>"></i> <?= $statusText ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="index.php?controller=product&action=updateProduct&product_id=<?= $p['product_id'] ?>"
                                class="btn-icon btn-edit" title="Chỉnh sửa">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="index.php?controller=product&action=deleteProduct&product_id=<?= $p['product_id'] ?>"
                                class="btn-icon btn-delete" title="Xóa" onclick="return confirm('Xóa sản phẩm này?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="8" class="empty-state py-5 text-center">
                        <i class="fas fa-box-open fa-4x text-muted mb-3 d-block"></i>
                        <h5 class="text-muted">Chưa có sản phẩm nào</h5>
                        <p class="text-muted">Hãy bắt đầu thêm sản phẩm đầu tiên</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- ========== CARD VIEW (Mobile) ========== -->
    <div class="products-grid" id="cardView">
        <?php if (!empty($listProduct)): ?>
        <?php foreach ($listProduct as $p): ?>
        <div class="product-card" data-status="<?= $p['status'] ?>"
            data-name="<?= strtolower(htmlspecialchars($p['product_name'])) ?>" data-id="<?= $p['product_id'] ?>">
            <?php if (!empty($p['image_url'])): ?>
            <img src="../../../../uploads/<?= $p['image_url'] ?>" class="card-img" alt="<?= $p['product_name'] ?>">
            <?php else: ?>
            <div class="card-img d-flex align-items-center justify-content-center bg-light">
                <i class="fas fa-image fa-3x text-muted"></i>
            </div>
            <?php endif; ?>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h6 class="card-title"><?= htmlspecialchars($p['product_name']) ?></h6>
                    <span class="badge-category">#<?= $p['product_id'] ?></span>
                </div>
                <div class="card-price">
                    <?php if (isset($p['discounted_price'])): ?>
                    <span class="text-danger fw-bold"><?= number_format($p['discounted_price'], 0, ',', '.') ?>₫</span>
                    <small class="text-muted text-decoration-line-through ms-2"
                        style="font-size: 0.85rem;"><?= number_format($p['price'], 0, ',', '.') ?>₫</small>
                    <?php else: ?>
                    <span class="text-success fw-bold"><?= number_format($p['price'], 0, ',', '.') ?>₫</span>
                    <?php endif; ?>
                </div>
                <div class="mt-2">
                    <?php
                            $statusClass = '';
                            $statusText = '';
                            switch ($p['status']) {
                                case 'available':
                                    $statusClass = 'badge-available';
                                    $statusText = 'Còn hàng';
                                    break;
                                case 'out_of_stock':
                                    $statusClass = 'badge-outstock';
                                    $statusText = 'Tạm hết';
                                    break;
                                case 'discontinued':
                                    $statusClass = 'badge-discontinued';
                                    $statusText = 'Ngừng KD';
                                    break;
                                default:
                                    $statusClass = 'badge-available';
                                    $statusText = 'Khác';
                            }
                            ?>
                    <span class="badge-status <?= $statusClass ?>"><?= $statusText ?></span>
                    <span class="badge-category ms-2"><i class="fas fa-folder"></i>
                        <?= htmlspecialchars($p['category_name']) ?></span>
                </div>
                <div class="card-info">
                    <span><i class="fas fa-boxes me-1"></i> SL: <?= number_format($p['stock_quantity']) ?></span>
                </div>
                <div class="action-buttons mt-3">
                    <a href="index.php?controller=product&action=updateProduct&product_id=<?= $p['product_id'] ?>"
                        class="btn-icon btn-edit" style="flex:1">
                        <i class="fas fa-pen me-1"></i> Sửa
                    </a>
                    <a href="index.php?controller=product&action=deleteProduct&product_id=<?= $p['product_id'] ?>"
                        class="btn-icon btn-delete" style="flex:1" onclick="return confirm('Xóa sản phẩm?')">
                        <i class="fas fa-trash-alt me-1"></i> Xóa
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Phân trang -->
    <?php if (isset($totalPages) && $totalPages > 1): ?>
    <nav class="pagination-modern mt-4">
        <ul class="pagination justify-content-center flex-wrap">
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
</div>

<style>
/* ========== CSS RIÊNG CHO VIEW SẢN PHẨM ========== */

/* Filter bar modern */
.filter-bar-modern {
    background: white;
    border-radius: 60px;
    padding: 8px 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
    justify-content: flex-end;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    border: 1px solid #e2e8f0;
}

.search-group {
    flex: 1;
    min-width: 280px;
    position: relative;
    margin-right: auto;
}

.search-group i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    z-index: 1;
}

.search-group input {
    padding-left: 42px;
    border-radius: 50px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
}

.search-group input:focus {
    background: white;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.filter-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-select {
    border-radius: 40px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    width: auto;
    padding: 8px 20px;
}

/* Table responsive */
.table-responsive-modern {
    overflow-x: auto;
    border-radius: 24px;
    background: white;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
}

.table-modern {
    width: 100%;
    min-width: 800px;
    border-collapse: collapse;
    font-size: 0.9rem;
}

.table-modern thead tr {
    background: #f8fafd;
    border-bottom: 2px solid #eef2ff;
}

.table-modern th {
    padding: 16px 12px;
    font-weight: 600;
    color: #1e293b;
    text-align: left;
    white-space: nowrap;
}

.table-modern td {
    padding: 14px 12px;
    vertical-align: middle;
    border-bottom: 1px solid #f0f2f5;
    text-align: left;
}

.table-modern tbody tr:hover {
    background: #fefce8;
}

.product-img {
    width: 156px;
    height: 156px;
    object-fit: cover;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    transition: transform 0.2s;
}

.product-img:hover {
    transform: scale(1.2);
    cursor: pointer;
    z-index: 10;
    position: relative;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.no-image-placeholder {
    width: 56px;
    height: 56px;
    background: #f1f5f9;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    font-size: 1.5rem;
}

.badge-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 100px;
    font-weight: 600;
    font-size: 0.75rem;
    white-space: nowrap;
}

.badge-available {
    background: #dcfce7;
    color: #15803d;
}

.badge-outstock {
    background: #fed7aa;
    color: #9a3412;
}

.badge-discontinued {
    background: #fee2e2;
    color: #b91c1c;
}

.badge-category {
    background: #f1f5f9;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.action-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.btn-icon {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: 0.2s;
    text-decoration: none;
}

.btn-edit {
    background: #eff6ff;
    color: #2563eb;
}

.btn-edit:hover {
    background: #2563eb;
    color: white;
    transform: translateY(-2px);
}

.btn-delete {
    background: #fef2f2;
    color: #dc2626;
}

.btn-delete:hover {
    background: #dc2626;
    color: white;
    transform: translateY(-2px);
}

.btn-primary-gradient {
    background: linear-gradient(105deg, #3b82f6, #06b6d4);
    border: none;
    padding: 10px 24px;
    border-radius: 40px;
    font-weight: 600;
    color: white;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.btn-primary-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(59, 130, 246, 0.3);
    color: white;
}

/* Card View cho mobile */
.products-grid {
    display: none;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.product-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: all 0.3s;
    border: 1px solid #eef2ff;
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
}

.card-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    background: #f1f5f9;
}

.card-body {
    padding: 16px;
}

.card-title {
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 8px;
}

.card-price {
    color: #059669;
    font-weight: 700;
    font-size: 1.2rem;
}

.card-info {
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid #eef2ff;
    font-size: 0.8rem;
}

/* Pagination */
.pagination-modern {
    margin-top: 28px;
}

.pagination-modern .page-link {
    border-radius: 40px;
    border: none;
    padding: 8px 16px;
    color: #334155;
    font-weight: 500;
    background: white;
    transition: 0.2s;
}

.pagination-modern .page-item.active .page-link {
    background: linear-gradient(135deg, #3b82f6, #06b6d4);
    color: white;
}

.pagination-modern .page-link:hover {
    background: #e2e8f0;
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .filter-bar-modern {
        flex-direction: column;
        border-radius: 28px;
        background: #f8fafc;
        padding: 16px;
    }

    .table-responsive-modern {
        display: none;
    }

    .products-grid {
        display: grid;
    }

    .search-group {
        width: 100%;
        margin-right: 0;
    }

    .filter-group {
        width: 100%;
        justify-content: stretch;
    }

    .filter-select {
        flex: 1;
    }
}

@media (min-width: 769px) and (max-width: 1100px) {
    .table-modern {
        min-width: 780px;
    }
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}
</style>

<!-- Filter JS -->
<script>
(function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const resetBtn = document.getElementById('resetFilterBtn');

    const tableRows = document.querySelectorAll('#tableBody tr');
    const cards = document.querySelectorAll('.product-card');

    function filterAll() {
        const keyword = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const statusVal = statusFilter ? statusFilter.value : '';

        // Filter table
        tableRows.forEach(row => {
            if (row.cells && row.cells.length > 0) {
                const name = row.getAttribute('data-name') || '';
                const id = row.getAttribute('data-id') || '';
                const status = row.getAttribute('data-status') || '';

                let match = true;
                if (keyword && !name.includes(keyword) && !id.includes(keyword)) match = false;
                if (statusVal && status !== statusVal) match = false;

                row.style.display = match ? '' : 'none';
            }
        });

        // Filter cards
        cards.forEach(card => {
            const name = card.getAttribute('data-name') || '';
            const id = card.getAttribute('data-id') || '';
            const status = card.getAttribute('data-status') || '';

            let match = true;
            if (keyword && !name.includes(keyword) && !id.includes(keyword)) match = false;
            if (statusVal && status !== statusVal) match = false;

            card.style.display = match ? '' : 'none';
        });
    }

    if (searchInput) searchInput.addEventListener('keyup', filterAll);
    if (statusFilter) statusFilter.addEventListener('change', filterAll);
    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            if (searchInput) searchInput.value = '';
            if (statusFilter) statusFilter.value = '';
            filterAll();
        });
    }
})();
</script>
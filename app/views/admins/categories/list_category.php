<?php
// code test data

require_once __DIR__ . '/../../../models/category_model.php';
require_once __DIR__ . '/../../../../config/config.php';
$category = new CategoryModel();
$listCategory = $category->getAllCategory();
?>

<!-- ========== NỘI DUNG CHÍNH CHO DASHBOARD ========== -->
<div class="container-fluid px-0">
    <!-- Header hiện đại -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold" style="letter-spacing: -0.02em;">
                <i class="fas fa-folder-tree me-2 text-primary"></i>Quản lý danh mục
            </h2>
            <p class="text-muted mb-0">Quản lý và sắp xếp các danh mục sản phẩm</p>
        </div>
        <a href="index.php?controller=category&action=addCategory" class="btn btn-primary-gradient mt-2 mt-sm-0">
            <i class="fas fa-plus-circle me-2"></i>Thêm danh mục
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
            <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm danh mục, mã ID..." autocomplete="off">
        </div>
        <div class="filter-group">
            <button id="resetFilterBtn" class="btn btn-secondary">
                <i class="fas fa-undo-alt me-1"></i>Reset
            </button>
        </div>
    </div>

    <!-- ========== TABLE VIEW (Desktop) ========== -->
    <div class="table-responsive-modern" id="tableView">
        <table class="table-modern" id="categoryTable">
            <thead>
                <tr>
                    <th style="width: 80px">Mã DM</th>
                    <th style="width: 200px">Tên danh mục</th>
                    <th>Mô tả</th>
                    <th style="width: 120px">Ngày tạo</th>
                    <th style="width: 120px">Ngày cập nhật</th>
                    <th style="width: 100px">Hành động</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php if (!empty($listCategory)): ?>
                    <?php foreach ($listCategory as $c): ?>
                        <tr data-name="<?= strtolower(htmlspecialchars($c['category_name'])) ?>"
                            data-id="<?= $c['category_id'] ?>">
                            <td class="text-primary fw-bold">#<?= $c['category_id'] ?></td>
                            <td class="fw-semibold">
                                <i class="fas fa-tag me-2" style="color: #3b82f6;"></i>
                                <?= htmlspecialchars($c['category_name']) ?>
                            </td>
                            <td>
                                <div class="description-truncate" title="<?= htmlspecialchars($c['description']) ?>">
                                    <?= htmlspecialchars($c['description'] ?: '—') ?>
                                </div>
                            </td>
                            <td class="text-muted small">
                                <i class="far fa-calendar-alt me-1"></i>
                                <?= date('d/m/Y', strtotime($c['created_at'])) ?>
                            </td>
                            <td class="text-muted small">
                                <i class="far fa-clock me-1"></i>
                                <?= $c['updated_at'] ? date('d/m/Y', strtotime($c['updated_at'])) : '—' ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="index.php?controller=category&action=updateCategory&category_id=<?= $c['category_id'] ?>"
                                        class="btn-icon btn-edit" title="Chỉnh sửa">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="index.php?controller=category&action=deleteCategory&category_id=<?= $c['category_id'] ?>"
                                        class="btn-icon btn-delete" title="Xóa"
                                        onclick="return confirm('Xóa danh mục này? Sản phẩm trong danh mục sẽ bị ảnh hưởng!')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-state py-5 text-center">
                            <i class="fas fa-folder-open fa-4x text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">Chưa có danh mục nào</h5>
                            <p class="text-muted">Hãy bắt đầu thêm danh mục đầu tiên</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- ========== CARD VIEW (Mobile) ========== -->
    <div class="products-grid" id="cardView">
        <?php if (!empty($listCategory)): ?>
            <?php foreach ($listCategory as $c): ?>
                <div class="product-card" 
                     data-name="<?= strtolower(htmlspecialchars($c['category_name'])) ?>"
                     data-id="<?= $c['category_id'] ?>">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h6 class="card-title">
                                <i class="fas fa-tag me-1" style="color: #3b82f6;"></i>
                                <?= htmlspecialchars($c['category_name']) ?>
                            </h6>
                            <span class="badge-category">#<?= $c['category_id'] ?></span>
                        </div>
                        <div class="card-info mt-2">
                            <div class="description-text small text-muted">
                                <i class="fas fa-align-left me-1"></i>
                                <?= htmlspecialchars(mb_substr($c['description'] ?: 'Không có mô tả', 0, 80)) ?>
                            </div>
                        </div>
                        <div class="card-info">
                            <span><i class="far fa-calendar-alt me-1"></i> <?= date('d/m/Y', strtotime($c['created_at'])) ?></span>
                            <span><i class="far fa-clock me-1"></i> <?= $c['updated_at'] ? date('d/m/Y', strtotime($c['updated_at'])) : '—' ?></span>
                        </div>
                        <div class="action-buttons mt-3">
                            <a href="index.php?controller=category&action=updateCategory&category_id=<?= $c['category_id'] ?>"
                                class="btn-icon btn-edit" style="flex:1">
                                <i class="fas fa-pen me-1"></i> Sửa
                            </a>
                            <a href="index.php?controller=category&action=deleteCategory&category_id=<?= $c['category_id'] ?>"
                                class="btn-icon btn-delete" style="flex:1"
                                onclick="return confirm('Xóa danh mục này?')">
                                <i class="fas fa-trash-alt me-1"></i> Xóa
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<style>
    /* ========== CSS GIỐNG FILE LIST PRODUCT ========== */
    
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
        cursor: pointer;
    }

    .description-truncate {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #6b7280;
        font-size: 0.85rem;
    }

    .badge-category {
        background: #f1f5f9;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        white-space: nowrap;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
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

    .card-body {
        padding: 16px;
    }

    .card-title {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .card-info {
        display: flex;
        justify-content: space-between;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #eef2ff;
        font-size: 0.7rem;
        color: #6b7280;
    }

    .description-text {
        color: #6b7280;
        font-size: 0.75rem;
        line-height: 1.4;
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
        const resetBtn = document.getElementById('resetFilterBtn');

        const tableRows = document.querySelectorAll('#tableBody tr');
        const cards = document.querySelectorAll('.product-card');

        function filterAll() {
            const keyword = searchInput ? searchInput.value.toLowerCase().trim() : '';

            // Filter table
            tableRows.forEach(row => {
                if (row.cells && row.cells.length > 0) {
                    const name = row.getAttribute('data-name') || '';
                    const id = row.getAttribute('data-id') || '';

                    let match = true;
                    if (keyword && !name.includes(keyword) && !id.includes(keyword)) match = false;

                    row.style.display = match ? '' : 'none';
                }
            });

            // Filter cards
            cards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                const id = card.getAttribute('data-id') || '';

                let match = true;
                if (keyword && !name.includes(keyword) && !id.includes(keyword)) match = false;

                card.style.display = match ? '' : 'none';
            });
        }

        if (searchInput) searchInput.addEventListener('keyup', filterAll);
        if (resetBtn) {
            resetBtn.addEventListener('click', () => {
                if (searchInput) searchInput.value = '';
                filterAll();
            });
        }
    })();
</script>
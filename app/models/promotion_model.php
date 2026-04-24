<?php
class PromotionModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = pdo_connect();
    }


    public function getAllPromotion()
    {
        $sql = "SELECT *FROM promotions ORDER BY promotion_id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByIdPromotion($promotion_id)
    {
        $sql = "SELECT *FROM promotions WHERE promotion_id=? ORDER BY promotion_id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$promotion_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Phân trang
    public function getPromotionPagination($limit, $offset)
    {
        $sql = "SELECT *FROM promotions 
        ORDER BY promotion_id ASC 
        LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countPromotion()
    {
        $sql = "SELECT COUNT(*) FROM promotions";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    // END Phân trang

    public function addPromotion(
        $promotion_code,
        $promotion_name,
        $description,
        $discount_value,
        $discount_type,
        $start_date,
        $end_date,
        $status
    ) {
        $sql = "INSERT INTO promotions (promotion_code,promotion_name,description,
        discount_value,discount_type,start_date,end_date,status)
        VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $promotion_code,
            $promotion_name,
            $description,
            $discount_value,
            $discount_type,
            $start_date,
            $end_date,
            $status
        ]);
        return $stmt;
    }

    public function getValueDiscountType()
    {
        $sql = "SHOW COLUMNS FROM promotions LIKE 'discount_type'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $listEnum = $row['Type'];
        preg_match("/^enum\('(.*)'\)$/", $listEnum, $matches);
        return explode("','", $matches[1]);
    }

    public function getValueStatus()
    {
        $sql = "SHOW COLUMNS FROM promotions LIKE 'status'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $listEnum = $row['Type'];
        preg_match("/^enum\('(.*)'\)$/", $listEnum, $matches);
        return explode("','", $matches[1]);
    }

    public function isPromotionCode($promotion_code)
    {
        $sql = "SELECT COUNT(*) FROM promotions WHERE promotion_code=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$promotion_code]);
        return $stmt->fetchColumn() > 0;
    }

    public function deletePromotion($promotion_id)
    {
        $sql = "DELETE FROM promotions WHERE promotion_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$promotion_id]);
        return $stmt->rowCount() > 0;
    }

    public function updatePromotion(
        $promotion_id,
        $promotion_name,
        $description,
        $discount_value,
        $discount_type,
        $start_date,
        $end_date,
        $status
    ) {
        $sql = "UPDATE promotions SET promotion_name=?, description=?, discount_value=?, discount_type=?, 
        start_date=?,end_date=?,status=? WHERE promotion_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $promotion_name,
            $description,
            $discount_value,
            $discount_type,
            $start_date,
            $end_date,
            $status,
            $promotion_id
        ]);
        return $stmt;
    }

    // lấy sp k phân trang phân trang
    public function getAllApplyProductPromotion()
    {
        $sql = "SELECT pp.product_promotion_id,pp.created_at,p.product_name,p.image_url, pr.discount_value,pr.discount_type, pr.promotion_code
         FROM product_promotions pp 
         JOIN products p ON pp.product_id=p.product_id
         JOIN promotions pr ON pp.promotion_id= pr.promotion_id
         ORDER BY pp.created_at
         WHERE pr.status = 'active'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPromotionActive()
    {
        $sql = "SELECT promotion_id, promotion_name,promotion_code,description FROM promotions WHERE status= 'active' ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductPromotions($productIds = [])
    {
        if (empty($productIds)) {
            return [];
        }

        $placeholders = str_repeat('?,', count($productIds) - 1) . '?';
        $sql = "SELECT pp.product_id, pr.discount_value, pr.discount_type, pr.promotion_code, pr.end_date
                FROM product_promotions pp
                JOIN promotions pr ON pp.promotion_id = pr.promotion_id
                WHERE pp.product_id IN ($placeholders) 
                AND pr.status = 'active' 
                AND pr.end_date >= CURDATE()
                ORDER BY pr.discount_value DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($productIds);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // lấy sp mà phân trang 
    public function getPaginationAllApplyProductPromotion($limit, $offset)
    {
        $sql = "SELECT pp.product_promotion_id, pp.created_at,
                   p.product_name, p.image_url,p.price,
                   pr.discount_value, pr.discount_type, pr.promotion_code,pr.status
            FROM product_promotions pp
            JOIN products p ON pp.product_id = p.product_id
            JOIN promotions pr ON pp.promotion_id = pr.promotion_id
            WHERE pr.status = 'active'
            ORDER BY pp.created_at ASC
            LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countApplyProductPromotion()
    {
        $sql = "SELECT COUNT(*) 
            FROM product_promotions pp
            JOIN products p ON pp.product_id = p.product_id
            JOIN promotions pr ON pp.promotion_id = pr.promotion_id
            WHERE pr.status = 'active'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function applyProductPromotion($product_id, $promotion_id)
    {
        $sql = "INSERT INTO product_promotions (product_id, promotion_id) VALUES (?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$product_id, $promotion_id]);
        return $stmt;
    }

    public function isCheckActiveProductPromotion($product_id)
    {
        $sql = "SELECT pp.*,pr.status
                FROM product_promotions pp
                JOIN promotions pr ON pp.promotion_id=pr.promotion_id
                WHERE pp.product_id=? AND pr.status='active'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function removeProductPromotion($product_promotion_id)
    {
        $sql = "DELETE FROM product_promotions WHERE product_promotion_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$product_promotion_id]);
        return $stmt->rowCount() > 0;
    }

    //lấy mà phân trang 
    public function getPaginationExpiredProductPromotion($limit, $offset)
    {
        $limit = (int)$limit;
        $offset = (int)$offset;

        $sql = "SELECT pp.*, p.product_name, p.image_url,p.price,
                   pr.promotion_code, pr.discount_type, pr.discount_value, pr.status
            FROM product_promotions pp
            JOIN products p ON pp.product_id = p.product_id
            JOIN promotions pr ON pp.promotion_id = pr.promotion_id
            WHERE pr.status = 'expired'
            ORDER BY pp.created_at DESC
            LIMIT $limit OFFSET $offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countExpiredProductPromotion()
    {
        $sql = "SELECT COUNT(*) FROM product_promotions pp
            JOIN promotions pr ON pp.promotion_id = pr.promotion_id
            WHERE pr.status = 'expired'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    //lấy mà không phân trang 
    public function getExpiredProductPromotion($limit, $offset)
    {
        $sql = "SELECT pp.*, p.product_name, p.image_url,p.price,
                   pr.promotion_code, pr.discount_type, pr.discount_value, pr.status
            FROM product_promotions pp
            JOIN products p ON pp.product_id = p.product_id
            JOIN promotions pr ON pp.promotion_id = pr.promotion_id
            WHERE pr.status = 'expired'
            ORDER BY pp.created_at DESC
            LIMIT ? OFFSET ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$limit, $offset]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countInactiveProductPromotion()
    {
        $sql = "SELECT COUNT(*) FROM product_promotions pp
            JOIN promotions pr ON pp.promotion_id = pr.promotion_id
            WHERE pr.status = 'inactive'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    //lấy mà phân trang
    public function getPaginationInactiveProductPromotion($limit, $offset)
    {
        $limit = (int)$limit;
        $offset = (int)$offset;

        $sql = "SELECT pp.*, p.product_name, p.image_url,p.price,
                   pr.promotion_code, pr.discount_type, pr.discount_value, pr.status
            FROM product_promotions pp
            JOIN products p ON pp.product_id = p.product_id
            JOIN promotions pr ON pp.promotion_id = pr.promotion_id
            WHERE pr.status = 'inactive'
            ORDER BY pp.created_at DESC
            LIMIT $limit OFFSET $offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //lấy mà không phân trang 
    public function getInactiveProductPromotion()
    {
        $sql = "SELECT pp.*, p.product_name, p.image_url,
                   pr.promotion_code, pr.discount_type, pr.discount_value, pr.status
            FROM product_promotions pp
            JOIN products p ON pp.product_id = p.product_id
            JOIN promotions pr ON pp.promotion_id = pr.promotion_id
            WHERE pr.status = 'inactive'
            ORDER BY pp.created_at DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByIdProductPromotion($product_promotion_id)
    {
        $sql = "SELECT pp.*, 
                   p.product_name, p.image_url,
                   pr.promotion_name, pr.promotion_code, pr.discount_type, pr.discount_value
            FROM product_promotions pp
            JOIN products p ON pp.product_id = p.product_id
            JOIN promotions pr ON pp.promotion_id = pr.promotion_id
            WHERE pp.product_promotion_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$product_promotion_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateProductPromotion($product_promotion_id, $promotion_id)
    {
        $sql = "UPDATE product_promotions SET promotion_id=? WHERE product_promotion_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$promotion_id, $product_promotion_id]);
        return $stmt->rowCount() > 0;
    }
    // /////////////////////////
    public function getPaginationAllProductPromotion($limit, $offset)
    {
        $limit = (int)$limit;
        $offset = (int)$offset;

        $sql = "SELECT pp.*, p.product_name, p.image_url,p.price,
                   pr.promotion_code, pr.discount_type, pr.discount_value, pr.status
            FROM product_promotions pp
            JOIN products p ON pp.product_id = p.product_id
            JOIN promotions pr ON pp.promotion_id = pr.promotion_id
            ORDER BY pp.created_at DESC
            LIMIT $limit OFFSET $offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAllProductPromotion()
    {
        $sql = "SELECT COUNT(*) 
            FROM product_promotions pp
            JOIN promotions pr ON pp.promotion_id = pr.promotion_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function calculatePromotionPrice($price, $discountType, $discountValue)
    {
        if ($discountType === 'percentage') {
            $discountAmount = ($price * $discountValue) / 100;
        } else {
            $discountAmount = $discountValue;
        }

        if ($discountAmount > $price) {
            $discountAmount = $price;
        }

        return [
            'discount_amount' => $discountAmount,
            'final_price' => $price - $discountAmount
        ];
    }
}

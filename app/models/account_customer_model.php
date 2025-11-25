<?php
class AccountCustomerModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = pdo_connect();
    }

    public function getAllAccountCustomer()
    {
        $sql = "SELECT * FROM customers";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function deleteAccountCustomer($customer_id)
    {
        $sql = "DELETE FROM customers WHERE customer_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$customer_id]);
        return $stmt->rowCount() > 0;
    }

    public function getByCustomerUsername($username)
    {
        $sql = "SELECT * FROM customers WHERE username=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

<?php
class AccountAdminModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = pdo_connect();
    }

    public function getAllAccountAdmin()
    {
        $pdo = pdo_connect();
        $sql = "SELECT *FROM admins";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function addAccountAdmin($username, $email, $hashedPass, $full_name, $phone)
    {
        $pdo = pdo_connect();
        $sql = "INSERT INTO admins (username,email,password,full_name,phone) VALUES (?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $hashedPass, $full_name, $phone]);
        return $stmt;
    }

    public function checkUsername($username)
    {
        $pdo = pdo_connect();
        $sql = "SELECT COUNT(*) FROM admins WHERE username=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetchColumn() > 0;
    }

    public function checkEmail($email)
    {
        $pdo = pdo_connect();
        $sql = "SELECT COUNT(*) FROM admins WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    public function deleteAccountAdmin($admin_id)
    {
        $pdo = pdo_connect();
        $sql = "DELETE FROM admins WHERE admin_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$admin_id]);
        return $stmt->rowCount() > 0;
    }
}

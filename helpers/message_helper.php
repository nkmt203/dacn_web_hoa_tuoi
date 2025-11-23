<?php
class MessageHelper
{
    public static function success($message)
    {
        $_SESSION['success'] = $message;
    }

    public static function error($message)
    {
        $_SESSION['error'] = $message;
    }

    public static function logMessage()
    {
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success alert-dismissible fade show mt-2' role='alert'>
                {$_SESSION['success']}
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            </div>";
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger alert-dismissible fade show mt-2' role='alert'>
                {$_SESSION['error']}
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            </div>";
            unset($_SESSION['error']);
        }
    }
}

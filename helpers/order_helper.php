<?php
class OrderHelper
{
    public static function randomOrderCode()
    {
        return $code = 'ORD' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
    }
}

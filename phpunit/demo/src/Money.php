<?php
/*
 * Author : slack 
 * Email : yajin160305@gmail.com
 * File : Money.php
 * CreateDate : 2016-12-01 01:00:17
 * */

class Money {
    private $amount;
    public function __construct($amount)
    {
        $this->amount = $amount;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function negate()
    {
        return new  Money(-1 * $this->amount);
    }
}
/* vim: set tabstop=4 set shiftwidth=4 */


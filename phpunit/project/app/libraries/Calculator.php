<?php
/*
 * Author : slack 
 * Email : yajin160305@gmail.com
 * File : Calculate.php
 * CreateDate : 2016-12-04 13:26:19
 * */


namespace App\Libraries;

class Calculator {
    public function add($num1, $num2)
    {
        if(!is_numeric($num1) || !is_numeric($num2)){
            throw new \InvalidArgumentException("非数字,请输入数字.");
        }
        return $num1 + $num2;
    }

    public function sub($num1, $num2)
    {
        if(!is_numeric($num1) || !is_numeric($num2)){
            throw new \InvalidArgumentException("非数字,请输入数字.");
        }
        return $num1 - $num2;
    }

    public function mul($num1, $num2)
    {
        if(!is_numeric($num1) || !is_numeric($num2)){
            throw new \InvalidArgumentException("非数字,请输入数字.");
        }
        return $num1 * $num2;
    }

    public function div($num1, $num2)
    {
        if(!is_numeric($num1) || !is_numeric($num2)){
            throw new \InvalidArgumentException("非数字,请输入数字.");
        }
        if(0 === $num2) {
            throw new \InvalidArgumentException("分母为零.");
        }
        return $num1 / $num2;
    }
}
/* vim: set tabstop=4 set shiftwidth=4 */


<?php
/*
 * Author : slack 
 * Email : yajin160305@gmail.com
 * File : MoneyTest.php
 * CreateDate : 2016-12-01 01:03:46
 * */

use PHPUnit\Framework\TestCase;
class MoneyTest extends TestCase{
    public function testCanbeNegated()
    {
        $a = new Money(1);
        $b = $a->negate();
        $this->assertEquals(-1, $b->getAmount());
    }
}
/* vim: set tabstop=4 set shiftwidth=4 */


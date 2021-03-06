<?php
/*
 * Author : slack 
 * Email : yajin160305@gmail.com
 * File : CalculatorTest.php
 * CreateDate : 2016-12-04 13:28:25
 * */

use App\Libraries\Calculator;
class CalculatorTest extends PHPUnit_Framework_TestCase {
    public function testAdd()
    {
        $calc = new Calculator();
        $this->assertEquals(4, $calc->add(2, 2));
    }    
    public function testSub()
    {
        $calc = new Calculator();
        $this->assertEquals(5, $calc->sub(9, 4));
    }    
    public function testMul()
    {
        $calc = new Calculator();
        $this->assertEquals(36, $calc->mul(9, 4));
    }    
    public function testDiv()
    {
        $calc = new Calculator();
        $this->assertEquals(3, $calc->div(9, 3));
    }    
}
/* vim: set tabstop=4 set shiftwidth=4 */


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
}
/* vim: set tabstop=4 set shiftwidth=4 */


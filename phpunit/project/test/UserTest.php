<?php
/*
 * Author : slack 
 * Email : yajin160305@gmail.com
 * File : UserTest.php
 * CreateDate : 2016-12-04 13:58:47
 * */
use App\Models\User;
class UserTest extends PHPUnit_Framework_TestCase {
    public function testShow()
    {
        $user = new User("李四", 23);
        $this->assertEquals(true, $user->show());
    }
}
/* vim: set tabstop=4 set shiftwidth=4 */


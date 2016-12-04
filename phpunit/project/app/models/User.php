<?php
/*
 * Author : slack 
 * Email : yajin160305@gmail.com
 * File : User.php
 * CreateDate : 2016-12-04 13:22:16
 * */

namespace App\Models;
class User {
    public function __construct($name = "hello", $age = 9)
    {
        $this->name = $name;
        $this->age = $age;
    }
    public function show()
    {
        echo $this->name . " : " . $this->age . "\n";
        return true;
    }

    private $name;
    private $age;
}
/* vim: set tabstop=4 set shiftwidth=4 */


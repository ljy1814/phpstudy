<?php
/*
 * Author : slack 
 * Email : yajin160305@gmail.com
 * File : demo.php
 * CreateDate : 2016-12-04 19:30:12
 * */

class demo {
    
}
$log = new Monolog\Logger('name');
$log->pushHandler(new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING));
$log->addWarning('Foo');
/* vim: set tabstop=4 set shiftwidth=4 */


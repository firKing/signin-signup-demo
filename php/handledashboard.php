<?php
/**
 * Created by PhpStorm.
 * User: firk1n
 * Date: 15/11/17
 * Time: 下午1:51
 */
include 'lib/Mysql.php';
include 'lib/function.php';

$userList = new Mysql('test');
$result = $userList->getArray('select * from user');

//dd($result);
<?php
include '../lib/Mysql.php';
include '../lib/function.php';
include '../lib/Jump.php';

$email = $_POST['email'];
$pwd = $_POST['password'];
$mysql = new Mysql('test');

$result = $mysql->find("select * from user where username = '$email'");

if($result == null || $result['password'] != $pwd){
    new Jump('../index.html', '账号或密码错误', 2);
}else{
    new Jump('../dashboard.php', '登陆成功', 1);
}
<?php
include '../lib/Mysql.php';
include '../lib/function.php';
include '../lib/Jump.php';

$email = $_POST['email'];
$pwd = $_POST['password'];

$mysql = new Mysql('test');
$result = $mysql->sql("insert into `user`(`username`, `password`) values ('$email', '$pwd')");

$condition = $result;

// 如果登录成功就 跳转到Dashboard页面
if ($condition == 1) {
    new Jump('../dashboard.php', '注册成功', 1);
}else{
    new Jump('../signup.html', '注册失败', 2);
}
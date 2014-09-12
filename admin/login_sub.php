<?php
include_once dirname(__FILE__) . '/../' . 'init.php';

$user=$_POST['username'];
$pw=$_POST['password'];
$pw=md5($pw);
session_start();

$sql = "select * from user where name='$user' and pw='$pw'";
$result = $db->fetchOne($sql);
if($result['name'])
{
    $_SESSION['user']=$result['name'];
    $_SESSION['type']=$result['type'];
    header('Location:index.php');
}else{
    header('Location:login.php');
}

?>


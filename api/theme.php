<?php
header("Content-type:application/json");
//获取页面风格
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$sql="select * from config where id =1";


$r = $db->fetchOne($sql);

#print_r($r);
if($r)
{
	$result['result']['themecolo']=$r['cvalue'];
	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

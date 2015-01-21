<?php
header("Content-type:application/json");
//获取留言列表接口
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$pagesize=15;
$avatar_img_base_dir="attachment/img/avatar".DIRECTORY_SEPARATOR;
@$_GET['page']=intval($_GET['page']);
if($_GET['page']>1)
{
	$page=$_GET['page'];
}else{
	$page=1;
}

$total_sql="select count(1) as total from message";

$total_info = $db->fetchOne($total_sql);



$total=$total_info['total'];
if($total>$page*$pagesize)
{
	$other_total=$total-$page*$pagesize;
}else{
	$other_total=0;
}
$other_total=ceil($total/$pagesize);//需求改了，旧需求没删
$start=($page-1)*$pagesize;
$list_sql="select * from message ";

$list_sql.=" order by id desc limit $start,$pagesize";



$list = $db->fetchAll($list_sql);
$result=array();

if($list)
{
	foreach($list as $v)
	{
		$info=array();
		$info['avatar']=$v['avatar'];
		$info['message']=$v['msg'];
		$info['time']=$v['time'];
		$info['usrname']=$v['uname'];
		$m_list[]=$info;

	}
	$result['result']['list']=$m_list;
	$result['total']=$other_total;
	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

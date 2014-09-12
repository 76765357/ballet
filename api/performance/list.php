<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$pagesize=15;
$performance_img_base_dir="attachment/img/performance".DIRECTORY_SEPARATOR;
@$_GET['page']=intval($_GET['page']);
if($_GET['page']>1)
{
	$page=$_GET['page'];
}else{
	$page=1;
}
@$year=intval($_GET['year']);
$total_info = $db->fetchOne("select count(1) as total from performance");
$total=$total_info['total'];
if($total>$page*$pagesize)
{
	$other_total=$total-$page*$pagesize;
}else{
	$other_total=0;
}
$other_total=ceil($total/$pagesize);;//需求改了，旧需求没删
$start=($page-1)*$pagesize;
$performancelist_sql="select a.id,a.title,b.file from performance a left join image b on a.img_id =b.id limit $start,$pagesize";

if($year)
{
	$performancelist_sql="select a.id,a.title,b.file from performance a left join image b on a.img_id =b.id where a.time like '%$year%' limit $start,$pagesize";
}

$performancelist = $db->fetchAll($performancelist_sql);
$result=array();
if($performancelist)
{
	foreach($performancelist as $v)
	{
		$performance_info=array();
		$performance_info['id']=$v['id'];
		if($v['file'])
		{
			$performance_info['image']=SITE_URL.$performance_img_base_dir.$v['file'];
		}else{
			$performance_info['image']="";
		}
		$performance_info['title']=$v['title'];
		$performance_list[]=$performance_info;

	}
	$result['result']['performancelist']=$performance_list;
	$result['total']=$other_total;
	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

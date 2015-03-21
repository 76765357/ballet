<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$pagesize=15;
$sche_img_base_dir="attachment/img/sche".DIRECTORY_SEPARATOR;
@$_GET['page']=intval($_GET['page']);
if($_GET['page']>1)
{
	$page=$_GET['page'];
}else{
	$page=1;
}

$total_sql="select count(1) as total from schedule";
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
$schelist_sql="select a.*,b.title r_title from schedule a,repertory b where a.rpt_id=b.id";


$schelist_sql.=" order by a.id desc limit $start,$pagesize";



$schelist = $db->fetchAll($schelist_sql);
$result=array();


if($schelist)
{
	foreach($schelist as $v)
	{
		$sche_info=array();
		$sche_info['id']=$v['id'];
		if($v['img_id']>0)
		{
			$img_id=$v['img_id'];
			$img_sql="select file from image where id=$img_id";
			$img_r = $db->fetchOne($img_sql);
			$sche_info['imgurl']=SITE_URL.$sche_img_base_dir.$img_r['file'];
		}else{
			$sche_info['imgurl']="";
		}
		$sche_info['title']=$v['title'];
		$sche_info['time']=$v['start_date'];
		$sche_info['endtime']=$v['end_date'];
		$sche_info['desc']=$v['description'];
		$sche_info['repertory']=$v['r_title'];
		$sche_info['address']=$v['addr'];
		$sche_info['phone']=$v['phone'];
		$sche_info['price']=$v['price'];
		$sche_info['ticket']=$v['ticket'];
		$sche_info['sessions']=$v['nop'];
		$sche_list[]=$sche_info;

	}
	$result['result']['schelist']=$sche_list;
	$result['total']=$other_total;
	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

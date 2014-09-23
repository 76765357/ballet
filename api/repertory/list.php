<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$pagesize=15;
$repertory_img_base_dir="attachment/img/repertory".DIRECTORY_SEPARATOR;
@$_GET['page']=intval($_GET['page']);
@$year=intval($_GET['year']);
if($_GET['page']>1)
{
	$page=$_GET['page'];
}else{
	$page=1;
}
$reserve=$_GET['reserve'];
$total_sql="select count(1) as total from repertory";
if($reserve==1) $total_sql.=" where reserve=1";

$total_info = $db->fetchOne($total_sql);
$total=ceil($total_info['total']/$pagesize);
if($total>$page*$pagesize)
{
	$other_total=$total-$page*$pagesize;
}else{
	$other_total=0;
}
$other_total=$total;//需求改了，旧需求没删
$start=($page-1)*$pagesize;

if($reserve==1)
{
	if($year)
		$repertorylist_sql="select a.id,a.title,b.file from repertory a , image b where a.img_id =b.id and a.reserve=1 where a.time like '%$year%' order by a.id desc limit $start,$pagesize";
	else
		$repertorylist_sql="select a.id,a.title,b.file from repertory a , image b where a.img_id =b.id and a.reserve=1 order by a.id desc limit $start,$pagesize";
}else{
	if($year)
		$repertorylist_sql="select a.id,a.title,b.file from repertory a left join image b on a.img_id =b.id where a.time like '%$year%' order by a.id desc limit $start,$pagesize";
	else
		$repertorylist_sql="select a.id,a.title,b.file from repertory a left join image b on a.img_id =b.id order by a.id desc limit $start,$pagesize";
}
#print $repertorylist_sql;
$repertorylist = $db->fetchAll($repertorylist_sql);
$result=array();
if($repertorylist)
{
	foreach($repertorylist as $v)
	{
		$repertory_info=array();
		$repertory_info['id']=$v['id'];
		if($v['file'])
		{
			$repertory_info['image']=SITE_URL.$repertory_img_base_dir.$v['file'];
		}else{
			$repertory_info['image']="";
		}
		$repertory_info['title']=$v['title'];
		$repertory_list[]=$repertory_info;

	}
	$result['result']['repertorylist']=$repertory_list;
	$result['total']=$other_total;
	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

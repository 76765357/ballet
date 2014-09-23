<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$pagesize=20;
$repertory_img_base_dir="attachment/img/repertory".DIRECTORY_SEPARATOR;
@$_GET['page']=intval($_GET['page']);
if($_GET['page']>1)
{
	$page=$_GET['page'];
}else{
	$page=1;
}
$total_info = $db->fetchOne("select count(1) as total from repertory");
$total=$total_info['total'];
if($total>$page*$pagesize)
{
	$other_total=$total-$page*$pagesize;
}else{
	$other_total=0;
}
$other_total=$total;//需求改了，旧需求没删
$start=($page-1)*$pagesize;
$repertorylist_sql="select a.id,a.title,b.file from repertory a left join image b on a.img_id =b.id order by a.id desc limit $start,$pagesize";

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

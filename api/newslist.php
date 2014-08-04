<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$pagesize=20;
$new_img_base_dir="attachment/img/news".DIRECTORY_SEPARATOR;
@$_GET['page']=intval($_GET['page']);
if($_GET['page']>1)
{
	$page=$_GET['page'];
}else{
	$page=1;
}

$total_info = $db->fetchOne("select count(1) as total from news;");
$total=$total_info['total'];
if($total>$page*$pagesize)
{
	$other_total=$total-$page*$pagesize;
}else{
	$other_total=0;
}
$other_total=$total;//需求改了，旧需求没删
$start=($page-1)*$pagesize;
$newslist_sql="select a.id,a.cate_id,a.title,b.file from news a left join image b on a.img_id =b.id limit $start,$pagesize";

$newslist = $db->fetchAll($newslist_sql);
$result=array();

if($newslist)
{
	foreach($newslist as $v)
	{
		$new_info=array();
		$new_info['category']=$v['cate_id'];
		$new_info['id']=$v['id'];
		if($v['file'])
		{
			$new_info['imgurl']=SITE_URL.$new_img_base_dir.$v['file'];
		}else{
			$new_info['imgurl']="";
		}
		$new_info['title']=$v['title'];
		$news_list[]=$new_info;

	}
	$result['result']['newslist']=$news_list;
	$result['total']=$other_total;
	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$pagesize=20;
$video_img_base_dir="attachment/img/video".DIRECTORY_SEPARATOR;
@$_GET['page']=intval($_GET['page']);
if($_GET['page']>1)
{
	$page=$_GET['page'];
}else{
	$page=1;
}
$total_info = $db->fetchOne("select count(1) as total from video");
$total=$total_info['total'];
if($total>$page*$pagesize)
{
	$other_total=$total-$page*$pagesize;
}else{
	$other_total=0;
}
$other_total=$total;//需求改了，旧需求没删
$start=($page-1)*$pagesize;

$videolist_sql="select * from video limit $start,$pagesize";

$videolist = $db->fetchAll($videolist_sql);
$result=array();
if($videolist)
{
	foreach($videolist as $v)
	{
		$video_info=array();
		$video_info['id']=$v['id'];
		if($v['image'])
		{
			$video_info['imgurl']=SITE_URL.$video_img_base_dir.$v['image'];
		}else{
			$video_info['imgurl']="";
		}

        if($v['file'])
        {
            $video_info['vediourl']=SITE_URL.$video_img_base_dir.$v['file'];
        }else{
            $video_info['vediourl']="";
        }
		$video_info['title']=$v['title'];
		$video_list[]=$video_info;

	}
	$result['result']['main']=$video_list;
	$result['total']=$other_total;
	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

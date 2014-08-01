<?php
header("Content-type: text/html; charset=utf-8");
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$news_img_base_dir="attachment/img/news".DIRECTORY_SEPARATOR;
$news_video_base_dir="attachment/video/news".DIRECTORY_SEPARATOR;

if(!is_numeric($_GET['newsid']))
{

	$result['success']='false';
	echo json_encode($result);
	exit;    
}
     
$newsid=$_GET['newsid'];

$newsinfo_sql="select * from news  where id =$newsid ";

$newesinfo = $db->fetchOne($newsinfo_sql);
#print_r($newesinfo);

$videoid=$newesinfo['vid'];
if($videoid)
{
	$videosql="select * from video where id =$videoid";
	$video = $db->fetchOne($videosql);

}

if($newesinfo)
{
	$news_pic_sql= "select image.file,image.desc from image, news_image where news_image.nid=$newsid and news_image.mid=image.id";
	$news_pic = $db->fetchAll($news_pic_sql);
	#print_r($news_pic);

	if($news_pic)
	foreach($news_pic as $v)
	{
		$image_info=array();
		
		$image_info['description']=$v['desc'];
		if($v['file'])
		{
			$image_info['image']=SITE_URL.$news_img_base_dir.$v['file'];
		}else{
			$image_info['image']="";
		}
		
		$image_list[]=$image_info;

	}
	$result['result']['detail']['description']=$newesinfo['description'];
	$result['result']['detail']['images']=$image_list;
	$result['result']['detail']['title']=$newesinfo['title'];

	if($video['file'])
	{
		$result['result']['detail']['video']['url']=SITE_URL.$news_video_base_dir.$video['file'];
		//确定表里是存地址还是id再补充
	}

	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

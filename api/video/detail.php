<?php
header("Content-type: text/html; charset=utf-8");
header("Content-type:application/json");
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$video_base_dir="attachment/video".DIRECTORY_SEPARATOR;
$video_img_base_dir="attachment/img/video".DIRECTORY_SEPARATOR;

if(!is_numeric($_GET['videoid']))
{

	$result['success']='false';
	echo json_encode($result);
	exit;    
}
     
$videoid=$_GET['videoid'];

$videoinfo_sql="select * from video  where id =$videoid ";

$videoinfo = $db->fetchOne($videoinfo_sql);


if($videoinfo)
{
	$num=$videoinfo['num']+1;
	$db->update('video',array("num"=>$num),"id={$videoid}");
/*
	$video_pic_sql= "select image.file,image.desc from image, video_image where video_image.vid=$videoid and video_image.mid=image.id";
	$video_pic = $db->fetchAll($video_pic_sql);

	if($video_pic)
	foreach($video_pic as $v)
	{
		$image_info=array();
		
		$image_info['description']=$v['desc'];
		if($v['file'])
		{
			$image_info['image']=SITE_URL.$video_img_base_dir.$v['file'];
		}else{
			$image_info['image']="";
		}
		
		$image_list[]=$image_info;

	}

*/
	$result['result']['detail']['description']=$videoinfo['description'];
	$result['result']['detail']['images']=$SITE_URL.$video_img_base_dir.$videoinfo['image'];;
	$result['result']['detail']['title']=$videoinfo['title'];
    $result['result']['detail']['subtitle']=$videoinfo['subtitle'];
	if($videoinfo['file'])
	{
		$result['result']['detail']['video']['url']=SITE_URL.$video_base_dir.$videoinfo['file'];
		$result['result']['detail']['video']['image']=SITE_URL.$video_img_base_dir.$videoinfo['image'];
	}

	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

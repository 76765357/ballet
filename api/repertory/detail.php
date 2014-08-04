<?php
header("Content-type: text/html; charset=utf-8");
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$performance_img_base_dir="attachment/img/performance".DIRECTORY_SEPARATOR;
$repertory_img_base_dir="attachment/img/repertory".DIRECTORY_SEPARATOR;
$repertory_video_base_dir="attachment/video".DIRECTORY_SEPARATOR;
$video_img_base_dir="attachment/img/video".DIRECTORY_SEPARATOR;

if(!is_numeric($_GET['repertoryid']))
{

	$result['success']='false';
	echo json_encode($result);
	exit;    
}
     
$repertoryid=$_GET['repertoryid'];

$repertoryinfo_sql="select * from repertory  where id =$repertoryid ";

$repertoryinfo = $db->fetchOne($repertoryinfo_sql);

$videoid=$repertoryinfo['vid'];
if($videoid)
{
	$videosql="select * from video where id =$videoid";
	$video = $db->fetchOne($videosql);

}

if($repertoryinfo)
{
	$repertory_pic_sql= "select image.file,image.desc from image, repertory_image where repertory_image.rid=$repertoryid and repertory_image.mid=image.id";
	$repertory_pic = $db->fetchAll($repertory_pic_sql);

	if($repertory_pic)
	foreach($repertory_pic as $v)
	{
		$image_info=array();
		
		$image_info['description']=$v['desc'];
		if($v['file'])
		{
			$image_info['image']=SITE_URL.$repertory_img_base_dir.$v['file'];
		}else{
			$image_info['image']="";
		}
		
		$image_list[]=$image_info;

	}


	$result['result']['detail']['description']=$repertoryinfo['desc'];
	$result['result']['detail']['images']=$image_list;
    $result['result']['detail']['price']=$repertoryinfo['price'];
    $result['result']['detail']['address']=$repertoryinfo['addr'];
    $result['result']['detail']['time']=$repertoryinfo['time'];
    $result['result']['detail']['phone']=$repertoryinfo['phone'];
	$result['result']['detail']['title']=$repertoryinfo['title'];
    $result['result']['detail']['subtitle']=$repertoryinfo['subtitle'];
	if($video['file'])
	{
		$result['result']['detail']['video']['url']=SITE_URL.$repertory_video_base_dir.$video['file'];
		$result['result']['detail']['video']['image']=SITE_URL.$video_img_base_dir.$video['image'];
	}

	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

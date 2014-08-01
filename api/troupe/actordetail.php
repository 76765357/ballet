<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$actor_img_base_dir="attachment/img/actor".DIRECTORY_SEPARATOR;

if(!is_numeric($_GET['actorid']))
{

	$result['success']='false';
	echo json_encode($result);
	exit;    
}
     
$actorid=$_GET['actorid'];

$actorinfo_sql="select a.*,b.name as catename,c.file from actor a , actor_cate b , image c  where a.id =$actorid and a.cid =b.id and a.bigavatar=c.id";

$actorinfo = $db->fetchOne($actorinfo_sql);
#print_r($actorinfo);

if($actorinfo)
{
	$repertory_pic_sql= "select image.file,image.desc from image, actor_image where actor_image.aid=$actorid and actor_image.mid=image.id";
	$repertory_pic = $db->fetchAll($repertory_pic_sql);
	//print_r($repertory_pic);
	if($repertory_pic)
	foreach($repertory_pic as $v)
	{
		$image_info=array();
		
		$image_info['description']=$v['desc'];
		if($v['file'])
		{
			$image_info['url']=SITE_URL.$actor_img_base_dir.$v['file'];
		}else{
			$image_info['url']="";
		}
		
		$image_list[]=$image_info;

	}
	$result['result']['actortitle']=$actorinfo['catename'];
	if($actorinfo['file'])
	{
		$result['result']['avatar']=SITE_URL.$actor_img_base_dir.$actorinfo['file'];
	}
	$result['result']['description']=$actorinfo['desc'];
	$result['result']['images']=$image_list;
	$result['result']['name']=$actorinfo['name'];

	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

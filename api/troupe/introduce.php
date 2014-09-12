<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$actor_img_base_dir="attachment/img/troupe".DIRECTORY_SEPARATOR;

     
$troupeid=1;

$troupeinfo_sql="select * from troupe where id=$troupeid";

$troupeinfo = $db->fetchOne($troupeinfo_sql);

if($troupeinfo)
{
	$troupe_pic_sql= "select image.file,image.desc from image, troupe_image where troupe_image.tid=$troupeid and troupe_image.mid=image.id";
	$troupe_pic = $db->fetchAll($troupe_pic_sql);
	if($troupe_pic)
	foreach($troupe_pic as $v)
	{
		$image_info=array();
		
		if($v['file'])
		{
			$image_info=SITE_URL.$actor_img_base_dir.$v['file'];
		}else{
			$image_info="";
		}
		
		$image_list[]=$image_info;

	}
    $result['result']['images']=$image_list;
	$result['result']['introduce']=strip_tags($troupeinfo['content']);

	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

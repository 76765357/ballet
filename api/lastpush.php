<?php
header("Content-type:application/json");
//最新推送
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$push_img_base_dir="attachment/img/push".DIRECTORY_SEPARATOR;

$sql="select * from push order by id desc";
$info = $db->fetchOne($sql);

if($info)
{
	if($info['img']>0)
	{
                $img_id=$info['img'];
                $img_sql="select file from image where id=$img_id";
                $img_r = $db->fetchOne($img_sql);
		$r_info['url']=SITE_URL.$push_img_base_dir.$img_r['file'];
	}else{
		$r_info['url']="";
	}
	$r_info['detail']=$info['detail'];

	$result['result']=$r_info;
	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

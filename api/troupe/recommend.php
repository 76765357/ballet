<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$actor_img_base_dir="attachment/img/actor".DIRECTORY_SEPARATOR;


$actorinfo_sql="select a.*,c.file from actor a , image c  where a.recommend =1  and a.bigavatar=c.id";

$actorinfo = $db->fetchAll($actorinfo_sql);
if($actorinfo)
{
	foreach($actorinfo as $v)
	{
		$actorarr=array();
		
		if($v['file'])
		{
			$actorarr['avatar']=SITE_URL.$actor_img_base_dir.$v['file'];
		}else{
			$actorarr['avatar']="";
		}
		$actorarr['id']=$v['id'];
		$actorarr['name']=$v['name'];
		
		$actor_list[]=$actorarr;

	}
	$result['result']['actorlist']=$actor_list;

	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

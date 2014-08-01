<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$actor_img_base_dir="attachment/img/actor".DIRECTORY_SEPARATOR;

$actorlist_sql="select a.id,a.name,b.name as catename,c.file from actor a , actor_cate b , image c where a.cid =b.id and a.bigavatar=c.id ";

$actorlist = $db->fetchAll($actorlist_sql);
#print_r($actorlist);

if($actorlist)
foreach($actorlist as $v)
{
	$c_actorlist[$v['catename']][]=$v;
}

$result=array();

if($c_actorlist)
{
	foreach($c_actorlist as $k => $v)
	{
		$c_cator_info=array();
		foreach($v as $vv)
		{
			$actor_info=array();
			if($vv['file'])
			{
				$actor_info['avatar']=SITE_URL.$actor_img_base_dir.$vv['file'];
			}else{
				$actor_info['avatar']="";
			}
			$actor_info['id']=$vv['id'];
			$actor_info['name']=$vv['name'];
			#$actors_list['catename']=$k;
			$actors_list[]=$actor_info;
		}
		$c_cator_info['catename']=$k;
		$c_cator_info['list']=$actors_list;
		$c_cator_list[]=$c_cator_info;

	}
	$result['result']['actorlist']=$c_cator_list;
	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$actor_img_base_dir="attachment/img/actor".DIRECTORY_SEPARATOR;
@$cate=intval($_GET['cate']);
$actorlist_sql="select a.id,a.name,a.des,b.name as catename,c.file from actor a , actor_cate b , image c where a.cid =b.id and a.avatar=c.id ";
if($cate){
	if($cate==999) 
	{
		$actorlist_sql.=" and a.recommend=1";
	}else{
		$actorlist_sql.=" and a.cid=$cate";
	}
}
$actorlist = $db->fetchAll($actorlist_sql);
#print_r($actorlist);

if($actorlist)

$result=array();

if($actorlist)
{
	$actors_list=array();
	foreach($actorlist as $vv)
	{
			#print_r($vv);
			$actor_info=array();
			if($vv['file'])
			{
				$actor_info['avatar']=SITE_URL.$actor_img_base_dir.$vv['file'];
			}else{
				$actor_info['avatar']="";
			}
			$actor_info['id']=$vv['id'];
			$actor_info['name']=$vv['name'];
			$actor_info['des']=$vv['des'];
			#$actors_list['catename']=$k;
			$actors_list[]=$actor_info;
	}

	
	$result['result']['actorlist']=$actors_list;
	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$pagesize=15;
$sche_img_base_dir="attachment/img/sche".DIRECTORY_SEPARATOR;
$repertory_img_base_dir="attachment/img/repertory".DIRECTORY_SEPARATOR;
@$_GET['page']=intval($_GET['page']);
if($_GET['page']>1)
{
	$page=$_GET['page'];
}else{
	$page=1;
}

$total_sql="select count(1) as total from schedule";
$total_info = $db->fetchOne($total_sql);


$total=$total_info['total'];
if($total>$page*$pagesize)
{
	$other_total=$total-$page*$pagesize;
}else{
	$other_total=0;
}
$other_total=ceil($total/$pagesize);//需求改了，旧需求没删
$start=($page-1)*$pagesize;
$schelist_sql="select a.* from schedule a";


#$schelist_sql.=" order by a.id desc limit $start,$pagesize";
$schelist_sql.=" limit $start,$pagesize";


$schelist = $db->fetchAll($schelist_sql);
$result=array();


if($schelist)
{
	foreach($schelist as $v)
	{
		$sche_info=array();
		$sche_info['id']=$v['id'];
		$sid=$v['id'];
		if($v['img_id']>0)
		{
			$img_id=$v['img_id'];
			$img_sql="select file from image where id=$img_id";
			$img_r = $db->fetchOne($img_sql);
			$sche_info['imgurl']=SITE_URL.$sche_img_base_dir.$img_r['file'];
		}else{
			$sche_info['imgurl']="";
		}
		$repertory_list=array();
		$repertory_sql="select repertory.id,repertory.title,repertory.desc,repertory.img_id from  schedule_repertory,repertory where schedule_repertory.sid=$sid and schedule_repertory.rid=repertory.id ";
		$r_list = $db->fetchAll($repertory_sql);
		
		if($r_list)
        	{
			foreach($r_list as $vv)
        		{
                		$repertory_info=array();
                		$repertory_info['id']=$vv['id'];
        
				if($vv['img_id'])
        			{
            				$pic_id=$vv['img_id'];
            				$pic_sql="select file from image where id=$pic_id";
            				$pic = $db->fetchOne($pic_sql);
        			
        				if($pic['file'])
        				{
            					$repertory_info['image']=SITE_URL.$repertory_img_base_dir.$pic['file'];
        				}else{
            					$repertory_info['image']="";
        				}
				}else{
					$repertory_info['image']="";
				}
                		$repertory_info['title']=$vv['title'];
                		$repertory_info['des']=$vv['des'];
                		$repertory_list[]=$repertory_info;

        		}
		}
		$sche_info['repertorylist']=$repertory_list;

		$sche_info['title']=$v['title'];
		$sche_info['time']=$v['start_date'];
		$sche_info['endtime']=$v['end_date'];
		$sche_info['desc']=$v['description'];
		#$sche_info['repertory']=$v['r_title'];
		$sche_info['address']=$v['addr'];
		$sche_info['phone']=$v['phone'];
		$sche_info['price']=$v['price'];
		$sche_info['ticket']=$v['ticket'];
		$sche_info['sessions']=$v['nop'];
		$sche_list[]=$sche_info;

	}
	$result['result']['schelist']=$sche_list;
	$result['total']=$other_total;
	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

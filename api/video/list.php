<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$pagesize=20;
$video_img_base_dir="attachment/img/video".DIRECTORY_SEPARATOR;



$videolist_sql="select video.*,recommend.type from video,recommend where recommend.cid=2 and recommend.rid=video.id and type >=1";

$videolist = $db->fetchAll($videolist_sql);


$result=array();
if($videolist)
{
	foreach($videolist as $v)
	{
		$video_info=array();
		$video_info['id']=$v['id'];
		if($v['image'])
		{
			$video_info['imgurl']=SITE_URL.$video_img_base_dir.$v['image'];
		}else{
			$video_info['imgurl']="";
		}

        if($v['file'])
        {
            $video_info['vediourl']=SITE_URL.$video_img_base_dir.$v['file'];
        }else{
            $video_info['vediourl']="";
        }
		$video_info['title']=$v['title'];
        if($v['type']==2){
		    $p_video_list[]=$video_info;
        }else if($v['type']==1){
            $video_list[]=$video_info;
        }
	}
	$result['result']['main']=$p_video_list;
    $result['result']['others']=$video_list;
	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

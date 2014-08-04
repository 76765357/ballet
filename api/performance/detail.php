<?php
header("Content-type: text/html; charset=utf-8");
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$performance_img_base_dir="attachment/img/performance".DIRECTORY_SEPARATOR;
$repertory_img_base_dir="attachment/img/repertory".DIRECTORY_SEPARATOR;
$performance_video_base_dir="attachment/video".DIRECTORY_SEPARATOR;
$video_img_base_dir="attachment/img/video".DIRECTORY_SEPARATOR;

if(!is_numeric($_GET['performanceid']))
{

	$result['success']='false';
	echo json_encode($result);
	exit;    
}
     
$performanceid=$_GET['performanceid'];

$performanceinfo_sql="select * from performance  where id =$performanceid ";

$performanceinfo = $db->fetchOne($performanceinfo_sql);
#print_r($newesinfo);

$videoid=$performanceinfo['vid'];
if($videoid)
{
	$videosql="select * from video where id =$videoid";
	$video = $db->fetchOne($videosql);

}

if($performanceinfo)
{
	$performance_pic_sql= "select image.file,image.desc from image, performance_image where performance_image.pid=$performanceid and performance_image.mid=image.id";
	$performance_pic = $db->fetchAll($performance_pic_sql);

	if($performance_pic)
	foreach($performance_pic as $v)
	{
		$image_info=array();
		
		$image_info['description']=$v['desc'];
		if($v['file'])
		{
			$image_info['image']=SITE_URL.$performance_img_base_dir.$v['file'];
		}else{
			$image_info['image']="";
		}
		
		$image_list[]=$image_info;

	}


    $repertory_sql= "select repertory.id,repertory.title,repertory.img_id from  performance_repertory,repertory where performance_repertory.pid=$performanceid and performance_repertory.rid=repertory.id";
    $repertory = $db->fetchAll($repertory_sql);

    if($repertory)
    foreach($repertory as $v)
    {
        $repertory_info=array();

        $repertory_info['id']=$v['id'];
        $repertory_info['title']=$v['title'];
        if($v['img_id'])
        {
            $pic_id=$v['img_id'];
            $pic_sql="select file from image where id=$pic_id";
            $pic = $db->fetchOne($pic_sql);
        }
        if($pic['file'])
        {
            $repertory_info['imgurl']=SITE_URL.$repertory_img_base_dir.$pic['file'];
        }else{
            $repertory_info['imgurl']="";
        }

        $repertory_list[]=$repertory_info;

    }




	$result['result']['detail']['description']=$performanceinfo['desc'];
	$result['result']['detail']['images']=$image_list;
    $result['result']['detail']['repertory']=$repertory_list;
    $result['result']['detail']['price']=$performanceinfo['price'];
    $result['result']['detail']['address']=$performanceinfo['addr'];
    $result['result']['detail']['time']=$performanceinfo['time'];
    $result['result']['detail']['phone']=$performanceinfo['phone'];
	$result['result']['detail']['title']=$performanceinfo['title'];
    $result['result']['detail']['subtitle']=$performanceinfo['subtitle'];
	if($video['file'])
	{
		$result['result']['detail']['video']['url']=SITE_URL.$performance_video_base_dir.$video['file'];
		$result['result']['detail']['video']['image']=SITE_URL.$video_img_base_dir.$video['image'];
	}

	$result['success']='ture';
}else{
	$result['success']='false';
}

echo json_encode($result);

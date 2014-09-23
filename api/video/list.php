<?php
header("Content-type:application/json");
//获取新闻列表接口
include_once dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."init.php";
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."conf.php";
$pagesize=15;
$video_img_base_dir="attachment/img/video".DIRECTORY_SEPARATOR;

@$_GET['page']=intval($_GET['page']);
if($_GET['page']>1)
{
    $page=$_GET['page'];
}else{
    $page=1;
}



$videolist_sql="select video.*,recommend.type from video,recommend where recommend.cid=2 and recommend.rid=video.id and type =2 order by video.id desc";

$videolist = $db->fetchAll($videolist_sql);
$id_str="";
foreach($videolist as $vv)
{
    $id_str.=$vv['id'].",";
}
$id_str="(".substr($id_str,0,-1).")";

$total_info = $db->fetchOne("select count(1) as total from video where id not in $id_str");
$total=ceil($total_info['total']/$pagesize);

$start=($page-1)*$pagesize;
$others_sql="select * from video where id not in $id_str order by id desc limit $start ,$pagesize";
$others_list = $db->fetchAll($others_sql);


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
		$p_video_list[]=$video_info;
	}

    foreach($others_list as $v)
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
        $others[]=$video_info;
    }

	$result['result']['main']=$p_video_list;
    $result['result']['others']=$others;
    $result['total']=$total;
	$result['success']='ture';

}else{
	$result['success']='false';
}

echo json_encode($result);

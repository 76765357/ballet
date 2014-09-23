<?php
header("Content-type:application/json");

include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$pagesize=15;
$new_img_base_dir="attachment/img/news".DIRECTORY_SEPARATOR;
$performance_img_base_dir="attachment/img/performance".DIRECTORY_SEPARATOR;
$repertory_img_base_dir="attachment/img/repertory".DIRECTORY_SEPARATOR;
$video_img_base_dir="attachment/img/video".DIRECTORY_SEPARATOR;
//数据库用法参考 DB.class.php
if($_GET['page']>1)
{
    $page=$_GET['page'];
}else{
    $page=1;
}

$total_info = $db->fetchOne("select count(1) as total from recommend where type=1;");
$total=ceil($total_info['total']/$pagesize);


$p_recommend=$db->fetchAll("select * from recommend where type=2 order by cid,rid desc;");


$start=($page-1)*$pagesize;
$recommend=$db->fetchAll("select * from recommend where type=1 order by cid,rid desc limit $start,$pagesize;");


foreach($p_recommend as $v)
{
    $id=$v['rid'];
    if($v['cid']==1)
    {
        $p_news[] = $db->fetchOne("select news.id,title,file from news,image where news.id=$id and news.img_id=image.id;");
    }
    if($v['cid']==2)
    {
        $p_video[] = $db->fetchOne("select id,title,image from video where id=$id;");
    }
    if($v['cid']==3)
    {
        $p_performance[] = $db->fetchOne("select performance.id,title,file from performance,image where performance.img_id=image.id and performance.id=$id;");
    }
    if($v['cid']==4)
    {
        $p_repertory[] = $db->fetchOne("select repertory.id,title,file from repertory,image where repertory.img_id=image.id and repertory.id=$id;");
    }
}


foreach($recommend as $v)
{
    $id=$v['rid'];
    if($v['cid']==1)
    {
        $news[] = $db->fetchOne("select news.id,title,file from news,image where news.id=$id and news.img_id=image.id;");
    }
    if($v['cid']==2)
    {
        $video[] = $db->fetchOne("select id,title,image from video where id=$id;");
    }
    if($v['cid']==3)
    {
        $performance[] = $db->fetchOne("select performance.id,title,file from performance,image where performance.img_id=image.id and performance.id=$id;");
    }
    if($v['cid']==4)
    {
        $repertory[] = $db->fetchOne("select repertory.id,title,file from repertory,image where repertory.img_id=image.id and repertory.id=$id;");
    }
}


$recommend_list=array();
$p_recommend_list=array();

if($p_news)
foreach($p_news as $v)
{
    if(!$v) continue;
    $recommend=array();
    $recommend['category']=1;
    $recommend['id']=$v['id'];
    $recommend['title']=$v['title'];
    if($v['file'])
    {
        $recommend['imgurl']=SITE_URL.$new_img_base_dir.$v['file'];
    }else{
        $recommend['imgurl']="";
    }
    $p_recommend_list[]=$recommend;


}


if($p_performance)
foreach($p_performance as $v)
{
    if(!$v) continue;
    $recommend=array();
    $recommend['category']=3;
    $recommend['id']=$v['id'];
    $recommend['title']=$v['title'];
    if($v['file'])
    {
        $recommend['imgurl']=SITE_URL.$performance_img_base_dir.$v['file'];
    }else{
        $recommend['imgurl']="";
    }
    $p_recommend_list[]=$recommend;


}


if($p_repertory)
foreach($p_repertory as $v)
{
    if(!$v) continue;
    $recommend=array();
    $recommend['category']=4;
    $recommend['id']=$v['id'];
    $recommend['title']=$v['title'];
    if($v['file'])
    {
        $recommend['imgurl']=SITE_URL.$repertory_img_base_dir.$v['file'];
    }else{
        $recommend['imgurl']="";
    }
    $p_recommend_list[]=$recommend;


}

if($p_video)
foreach($p_video as $v)
{
    if(!$v) continue;
    $recommend=array();
    $recommend['category']=2;
    $recommend['id']=$v['id'];
    $recommend['title']=$v['title'];
    if($v['image'])
    {
        $recommend['imgurl']=SITE_URL.$video_img_base_dir.$v['image'];
    }else{
        $recommend['imgurl']="";
    }
    $p_recommend_list[]=$recommend;


}
#echo json_encode($p_recommend_list);




if($news)
foreach($news as $v)
{
    if(!$v) continue;
    $recommend=array();
    $recommend['category']=1;
    $recommend['id']=$v['id'];
    $recommend['title']=$v['title'];
    if($v['file'])
    {
        $recommend['imgurl']=SITE_URL.$new_img_base_dir.$v['file'];
    }else{
        $recommend['imgurl']="";
    }
    $recommend_list[]=$recommend;


}

if($performance)
foreach($performance as $v)
{
    if(!$v) continue;
    $recommend=array();
    $recommend['category']=3;
    $recommend['id']=$v['id'];
    $recommend['title']=$v['title'];
    if($v['file'])
    {
        $recommend['imgurl']=SITE_URL.$performance_img_base_dir.$v['file'];
    }else{
        $recommend['imgurl']="";
    }
    $recommend_list[]=$recommend;


}


if($repertory)
foreach($repertory as $v)
{
    if(!$v) continue;
    $recommend=array();
    $recommend['category']=4;
    $recommend['id']=$v['id'];
    $recommend['title']=$v['title'];
    if($v['file'])
    {
        $recommend['imgurl']=SITE_URL.$repertory_img_base_dir.$v['file'];
    }else{
        $recommend['imgurl']="";
    }
    $recommend_list[]=$recommend;


}

if($video)
foreach($video as $v)
{
    if(!$v) continue;
    $recommend=array();
    $recommend['category']=2;
    $recommend['id']=$v['id'];
    $recommend['title']=$v['title'];
    if($v['image'])
    {
        $recommend['imgurl']=SITE_URL.$video_img_base_dir.$v['image'];
    }else{
        $recommend['imgurl']="";
    }
    $recommend_list[]=$recommend;


}

#echo json_encode($recommend_list);
$result['result']['main']=$p_recommend_list;
$result['result']['others']=$recommend_list;
$result['total']=$total;
$result['success']='ture';
echo json_encode($result);
#$actor = $db->query("show create table actor;");
#var_dump($actor);


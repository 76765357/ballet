<?php
header("Content-type:application/json");
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$new_img_base_dir="attachment/img/news".DIRECTORY_SEPARATOR;
$performance_img_base_dir="attachment/img/performance".DIRECTORY_SEPARATOR;
$repertory_img_base_dir="attachment/img/repertory".DIRECTORY_SEPARATOR;
$video_img_base_dir="attachment/img/video".DIRECTORY_SEPARATOR;
//数据库用法参考 DB.class.php

$news = $db->fetchAll("select news.id,title,file,recommend from news,image where recommend>=1 and news.img_id=image.id;");
print_r($news);

$performance = $db->fetchAll("select performance.id,title,file,recommend from performance,image where recommend>=1 and performance.img_id=image.id;");
print_r($performance);

$repertory = $db->fetchAll("select repertory.id,title,file,recommend from repertory,image where recommend>=1 and repertory.img_id=image.id;");
print_r($repertory);

$video = $db->fetchAll("select id,title,image,recommend from video where recommend>=1;");
print_r($video);


$recommend_list=array();
$p_recommend_list=array();

if($news)
foreach($news as $v)
{
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
    if($v['recommend']==1)
    {
        $recommend_list[]=$recommend;
    }elseif($v['recommend']==2){
        $p_recommend_list[]=$recommend;
    }


}


if($performance)
foreach($performance as $v)
{
    $recommend=array();
    $recommend['category']=1;
    $recommend['id']=$v['id'];
    $recommend['title']=$v['title'];
    if($v['file'])
    {
        $recommend['imgurl']=SITE_URL.$performance_img_base_dir.$v['file'];
    }else{
        $recommend['imgurl']="";
    }
    if($v['recommend']==1)
    {
        $recommend_list[]=$recommend;
    }elseif($v['recommend']==2){
        $p_recommend_list[]=$recommend;
    }


}


if($repertory)
foreach($repertory as $v)
{
    $recommend=array();
    $recommend['category']=1;
    $recommend['id']=$v['id'];
    $recommend['title']=$v['title'];
    if($v['file'])
    {
        $recommend['imgurl']=SITE_URL.$repertory_img_base_dir.$v['file'];
    }else{
        $recommend['imgurl']="";
    }
    if($v['recommend']==1)
    {
        $recommend_list[]=$recommend;
    }elseif($v['recommend']==2){
        $p_recommend_list[]=$recommend;
    }


}

if($video)
foreach($video as $v)
{
    $recommend=array();
    $recommend['category']=1;
    $recommend['id']=$v['id'];
    $recommend['title']=$v['title'];
    if($v['image'])
    {
        $recommend['imgurl']=SITE_URL.$video_img_base_dir.$v['image'];
    }else{
        $recommend['imgurl']="";
    }
    if($v['recommend']==1)
    {
        $recommend_list[]=$recommend;
    }elseif($v['recommend']==2){
        $p_recommend_list[]=$recommend;
    }


}
echo json_encode($p_recommend_list);
#$actor = $db->query("show create table actor;");
#var_dump($actor);

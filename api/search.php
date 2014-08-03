<?php
header("Content-type:application/json");
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$actor_img_base_dir="attachment/img/actor".DIRECTORY_SEPARATOR;
@$_GET['page']=intval($_GET['page']);
@$type=htmlspecialchars(trim($_GET['type']));
@$keyword=htmlspecialchars(trim($_GET['keyword']));

if(empty($type) or empty($keyword))
{
    $result['success']='false';
    echo json_encode($result);
    exit;
}


if($_GET['page']>1)
{
    $page=$_GET['page'];
}else{
    $page=1;
}

switch ($type)
{
case "actor":
    $actorlist_sql="select a.id,a.name,b.name as catename,c.file from actor a , actor_cate b , image c where a.cid =b.id and a.bigavatar=c.id and a.name like '$keyword'";

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

    break;

case "repertory":
    $repertorylist_sql="select a.id,a.title,b.file from repertory a left join image b on a.img_id =b.id and a.title like '$keyword'";

    $repertorylist = $db->fetchAll($repertorylist_sql);
    $result=array();
    if($repertorylist)
    {
        foreach($repertorylist as $v)
        {
            $repertory_info=array();
            $repertory_info['id']=$v['id'];
            if($v['file'])
            {
                $repertory_info['image']=SITE_URL.$repertory_img_base_dir.$v['file'];
            }else{
                $repertory_info['image']="";
            }
            $repertory_info['title']=$v['title'];
            $repertory_list[]=$repertory_info;

        }
        $result['result']['repertorylist']=$repertory_list;
        $result['total']=$other_total;
        $result['success']='ture';
    }else{
        $result['success']='false';
    }

    echo json_encode($result);


    break;
case "performance":
$performancelist_sql="select a.id,a.title,b.file from performance a left join image b on a.img_id =b.id and a.title like '$keyword'";

    $performancelist = $db->fetchAll($performancelist_sql);
    $result=array();
    if($performancelist)
    {
        foreach($performancelist as $v)
        {
            $performance_info=array();
            $performance_info['id']=$v['id'];
            if($v['file'])
            {
                $performance_info['image']=SITE_URL.$performance_img_base_dir.$v['file'];
            }else{
                $performance_info['image']="";
            }
            $performance_info['title']=$v['title'];
            $performance_list[]=$performance_info;

        }
        $result['result']['performancelist']=$performance_list;
        $result['total']=$other_total;
        $result['success']='ture';
    }else{
        $result['success']='false';
    }

    echo json_encode($result);
    break;
default:
    $result['success']='false';
    echo json_encode($result);
}
?>

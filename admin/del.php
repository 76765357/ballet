<?php
/*
 * 所有删除在这里
 * 
*/
include_once dirname(__FILE__) . '/../' . 'init.php';

$id = v('id');
//操作表名
$tbname = v('tbname');
switch ($tbname):
	//演员
    case 'actor':
    	$db->delete('actor',"id={$id}");
    	$db->delete('actor_image',"aid={$id}");
    	break;
    case 'news':
    	$db->delete('news',"id={$id}");
    	$db->delete('news_image',"nid={$id}");
        break;
    case 'rpt':
    	$db->delete('repertory',"id={$id}");
    	$db->delete('repertory_image',"rid={$id}");
        break;
    case 'pfm':
    	$db->delete('performance',"id={$id}");
    	$db->delete('performance_image',"pid={$id}");
    	$db->delete('performance_repertory',"pid={$id}");
        break;
    case 'sche':
    	$db->delete('schedule',"id={$id}");
        break;
    case 'message':
    	$db->delete('message',"id={$id}");
        break;
    case 'video':
    	$db->delete('video',"id={$id}");
        break;
    case 'audi':
    	$db->delete('audi',"id={$id}");
        break;
    default:
        echo "wrong!";
endswitch;

if($db->affectedRows() > 0){
	ajax_json(array('status'=>0,'msg'=>'success'));
}else{
	ajax_json(array('status'=>1,'msg'=>'failed'));
}

$db->close();

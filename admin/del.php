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
    case 2:
        echo "i equals 2";
        break;
    default:
        echo "i is not equal to 0, 1 or 2";
endswitch;

if($db->affectedRows() > 0){
	ajax_json(array('status'=>0,'msg'=>'success'));
}else{
	ajax_json(array('status'=>1,'msg'=>'failed'));
}

$db->close();
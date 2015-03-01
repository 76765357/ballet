<?php
include_once dirname(__FILE__) . '/../' . 'init.php';

$cate	= t(v('cate'));
if(!$cate){
	$sql = "select * from actor";
}else{
	$sql = "select * from actor where cid={$cate}";
}
$data['action'] = 'actor';
$result = $db->fetchAll($sql);
$data['result'] = $result;
$data['yesno'] = $yesno;
$data['actor_cate'] = get_actor_cate();
render($data,'index');  

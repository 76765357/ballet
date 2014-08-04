<?php
include_once dirname(__FILE__) . '/../' . 'init.php';

$data['action'] = 'video';
$sql = "select * from video";
$result = $db->fetchAll($sql);
$data['result'] = $result;
$data['yesno'] = $yesno;
//$data['actor_cate'] = get_actor_cate();
render($data,'index');  

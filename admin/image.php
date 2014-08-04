<?php
include_once dirname(__FILE__) . '/../' . 'init.php';

$data['action'] = 'image';
$sql = "select * from image";
$result = $db->fetchAll($sql);
$data['result'] = $result;
$data['yesno'] = $yesno;
//$data['actor_cate'] = get_actor_cate();
render($data,'index');  

<?php
include_once dirname(__FILE__) . '/../' . 'init.php';

$data['action'] = 'performance';
$sql = "select * from performance";
$result = $db->fetchAll($sql);
$data['result'] = $result;
$data['yesno'] = $yesno;
//$data['actor_cate'] = get_actor_cate();
render($data,'index');  

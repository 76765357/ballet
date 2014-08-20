<?php
include_once dirname(__FILE__) . '/../' . 'init.php';

$data['action'] = 'video';
$sql = "select * from video";
$result = $db->fetchAll($sql);
foreach ($result as $key => $value) {
	# code...
	$type = $db->fetchSclare("select type from recommend where cid=2 and rid=".$value['id']);
	$result[$key]['type'] = $type;
}

$data['result'] = $result;
$data['yesno'] = $yesno;
render($data,'index');  

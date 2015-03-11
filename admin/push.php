<?php
include_once dirname(__FILE__) . '/../' . 'init.php';

$sql = "select * from push";
$data['action'] = 'push';
$result = $db->fetchAll($sql);
$data['result'] = $result;
//$data['yesno'] = $yesno;
render($data,'index');  

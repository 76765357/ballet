<?php
include_once dirname(__FILE__) . '/../' . 'init.php';

$data['action'] = 'message';
$sql = "select * from message";
$result = $db->fetchAll($sql);
$data['result'] = $result;
render($data,'index');  

<?php
include_once dirname(__FILE__) . '/../' . 'init.php';

$data['action'] = 'audi';
$sql = "select * from audi";
$result = $db->fetchAll($sql);
$data['result'] = $result;
render($data,'index');  

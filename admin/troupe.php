<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'troupe';
$sql = "select * from troupe where id=1";
$result = $db->fetchOne($sql);
$data['result'] = $result;
render($data,'index');  

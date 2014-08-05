<?php
include_once dirname(__FILE__) . '/../' . 'init.php';

$data['action'] = 'actor';
$sql = "select * from actor";
$result = $db->fetchAll($sql);
$data['result'] = $result;
$data['yesno'] = $yesno;
$data['js'][] = 'js/list.js';
$data['actor_cate'] = get_actor_cate();
render($data,'index');  

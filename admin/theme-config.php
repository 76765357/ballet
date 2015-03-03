<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'theme-color';
$data['js'][] = 'js/submit.js';
$type = 'theme-config';
$result = $db->fetchOne("select * from config where id='1'");
$data = array_merge($data,$result);
$db->close();
render($data,'index');

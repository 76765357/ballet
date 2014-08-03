<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data = array();
$data['action'] = 'news';
$sql = "select * from news order by id asc";
$result = $db->fetchAll($sql);
$data['result'] = $result;
$data['news_cate'] = get_news_cate();
render($data,'index');

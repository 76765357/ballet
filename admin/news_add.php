<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'news_add';
$data['js'][] = 'js/submit.js';
$data['news_cate_select'] = get_news_cate_select();
render($data,'index');

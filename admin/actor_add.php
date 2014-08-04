<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'actor_add';
$data['js'][] = 'js/submit.js';
$data['actor_cate_select'] = get_actor_cate_select();
render($data,'index');

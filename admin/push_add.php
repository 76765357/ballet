<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'push_add';
$data['js'][] = 'js/submit.js';
$type = 'push';
$id = getReqInt('id');
$data['single_image_text'] = '推送概要图';
$data['single_image_moudle'] = $type;
$data['multi_image_text'] = '新闻图片';
$data['multi_image_moudle'] = $type;
render($data,'index');

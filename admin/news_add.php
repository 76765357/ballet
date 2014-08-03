<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data = array();
$data['js'][] = '../vender/jquploader/js/vendor/jquery.ui.widget.js';
$data['js'][] = '../vender/jquploader/js/jquery.iframe-transport.js';
$data['js'][] = '../vender/jquploader/js/jquery.fileupload.js';
$data['action'] = 'news_add';
$data['js'][] = 'js/submit.js';
$data['news_cate_select'] = get_news_cate_select();
render($data,'index');

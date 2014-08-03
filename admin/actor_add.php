<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data = array();
$data['action'] = 'actor_add';
$data['js'][] = '../vender/jquploader/js/vendor/jquery.ui.widget.js';
$data['js'][] = '../vender/jquploader/js/jquery.iframe-transport.js';
$data['js'][] = '../vender/jquploader/js/jquery.fileupload.js';
$data['js'][] = 'js/submit.js';
$data['actor_cate_select'] = get_actor_cate_select();
render($data,'index');

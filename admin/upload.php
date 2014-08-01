<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
require(dirname(__FILE__) . '/../vender/jquploader/server/php/UploadHandler.php');

$a = t(v('a'));
$base_config = array(
    'thumbnail' => array(
            'max_width' => 120,
            'max_height' => 120
        )
);
//演员
if($a == 'actor'){
	$res =  '/../attachment/img/actor/' ; 
	$options = array(
		'upload_dir' => dirname(__FILE__) . $res,
		'upload_url' => get_full_url() . $res
	);
}

//剧照
if($a == 'rpt'){
	$res =  '/../attachment/img/rpt/' ; 
	$options = array(
		'upload_dir' => dirname(__FILE__) . $res,
		'upload_url' => get_full_url() . $res
	);
}
$options = $options + $base_config;
$upload_handler = new UploadHandler($options);


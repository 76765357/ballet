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

class CustomUploadHandler extends UploadHandler {

    protected function initialize() {
        global $db;
	$this->db = $db;
        parent::initialize();
        $this->db->close();
    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
            $index = null, $content_range = null) {
        $file = parent::handle_file_upload(
            $uploaded_file, $name, $size, $type, $error, $index, $content_range
        );
        if (empty($file->error)) {
            $data = array('file'=>$file->name);
            $this->db->insert('image',$data);
            $file->id = $this->db->insertId();
        }
        return $file;
    }
}
$upload_handler = new CustomUploadHandler($options);


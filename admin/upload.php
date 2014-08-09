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
	$options = array(
		'upload_dir' => dirname(__FILE__) . ACTOR_RES,
		'upload_url' => get_full_url() . ACTOR_RES
	);
}

//剧目
if($a == 'rpt'){
	$options = array(
		'upload_dir' => dirname(__FILE__) . RPT_RES,
		'upload_url' => get_full_url() . RPT_RES
	);
}

//新闻
if($a == 'news'){
	$options = array(
		'upload_dir' => dirname(__FILE__) . NEWS_RES,
		'upload_url' => get_full_url() . NEWS_RES
	);
}

//演出
if($a == 'pfm'){
	$options = array(
		'upload_dir' => dirname(__FILE__) . PFM_RES,
		'upload_url' => get_full_url() . PFM_RES
	);
}

//剧团
if($a == 'trp'){
    $options = array(
        'upload_dir' => dirname(__FILE__) . TRP_RES,
        'upload_url' => get_full_url() . TRP_RES
    );
}

//视频
if($a == 'video'){
    $options = array(
        'upload_dir' => dirname(__FILE__) . VIDEO_RES,
        'upload_url' => get_full_url() . VIDEO_RES
    );
}

//视频
if($a == 'videoimg'){
    $options = array(
        'upload_dir' => dirname(__FILE__) . VIDEO_IMG_RES,
        'upload_url' => get_full_url() . VIDEO_IMG_RES
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
            if(strpos($file->type,'video') !== false){
                $data = array('file'=>$file->name);
                $this->db->insert('video',$data);
                $file->id = $this->db->insertId();
            }else if(strpos($file->type,'image') !== false){
                $data = array('file'=>$file->name);
                $this->db->insert('image',$data);
                $file->id = $this->db->insertId();
            }else{
                //非视频或图片文件
            }
        }
        return $file;
    }
}
$upload_handler = new CustomUploadHandler($options);


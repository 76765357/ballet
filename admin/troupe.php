<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'troupe';
$data['js'][] = 'js/submit.js';
#$id = 1;
$id = v('id');
if(empty($id)) $id=1;

$data['multi_image_text'] = '剧团照片';
if($id==2) $data['multi_image_text'] = '乐团照片';
$data['multi_image_moudle'] = 'trp';
if($id > 0){
	$result = $db->fetchOne("select * from troupe where id='{$id}'");
	if($result){
		$img = get_img_from_db($result['avatar']);
		$data['avatar_src'] = TRP_RES_THUMB.get_full_url().'/'.$img['file'];
		$data['multi_image'] = get_imgs($id,'trp');
		$data = array_merge($data,$result);
	}
}

render($data,'index');  

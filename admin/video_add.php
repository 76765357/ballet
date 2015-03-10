<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'video_add';
$data['js'][] = 'js/submit.js';
$type = 'video';
$id = getReqInt('id');
if($id > 0){
	$result = $db->fetchOne("select * from video where id='{$id}'");
	if($result){
		$data['video_img'] = $result['image'];
		$data['video_img_src'] = get_full_url().VIDEO_IMG_RES_THUMB.$result['image'];
		$data['video_img_ori_src'] = get_full_url().VIDEO_IMG_RES.$result['image'];
		$data['video'] = $result['id'];
		$data['video_src'] = get_full_url().VIDEO_RES.$result['file'];
		
		$data = array_merge($data,$result);
	}
}//VIDEO_RES
$db->close();
render($data,'index');

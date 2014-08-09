<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'repertory_add';
$data['js'][] = 'js/submit.js';
$id = getReqInt('id');
$type = 'rpt';
$data['multi_image_text'] = '剧照';
$data['multi_image_moudle'] = 'rpt';
$data['single_image_text'] = '剧照主图';
$data['single_image_moudle'] = $type;

if($id > 0){
	$result = $db->fetchOne("select * from repertory where id='{$id}'");
	if($result){
		$img = get_img_from_db($result['img_id']);
		$data['avatar'] = $result['img_id'];
		$data['avatar_src'] = RPT_RES_THUMB . $img['file'];
		$data['avatar_ori_src'] = RPT_RES . $img['file'];
		$data['multi_image'] = get_imgs($id,$type);

		if($result['vid'] > 0){
			$vinfo = $db->fetchOne("select * from video where id={$result['vid']}");
			$data['video']			= $vinfo['id'];
			$data['video_title'] 	= $vinfo['title'];
			$data['video_subtitle'] = $vinfo['subtitle'];
			$data['video_src'] 		= get_full_url() . VIDEO_RES . $vinfo['file'];
			$data['video_desc'] 	= $vinfo['description'];
			$data['video_img'] 		= $vinfo['image'];
			$data['video_img_src']	= get_full_url() . VIDEO_IMG_RES_THUMB . $vinfo['image'];
			$data['video_img_ori_src']	= get_full_url() . VIDEO_IMG_RES . $vinfo['image'];
		}
		
		$data = array_merge($data,$result);
	}
}


render($data,'index');

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
$data['video_list'] = output_video_list();
if($id > 0){
	$result = $db->fetchOne("select * from repertory where id='{$id}'");
	if($result){
		$img = get_img_from_db($result['img_id']);
		$data['avatar'] = $result['img_id'];
		$data['avatar_src'] = get_full_url() . RPT_RES_THUMB . $img['file'];
		$data['avatar_ori_src'] = get_full_url() . RPT_RES . $img['file'];
		$data['multi_image'] = get_imgs($id,$type);

		if($result['vid'] > 0){
			$vdata = output_video_data($result['vid']);
			$data = array_merge($data,$vdata);
		}
		
		$data = array_merge($data,$result);
	}
}
$db->close();
render($data,'index');

<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'repertory_add';
$data['js'][] = 'js/submit.js';
$id = getReqInt('id');
$data['multi_image_text'] = '剧照';
$data['single_image_text'] = '剧照主图';
$data['multi_image_moudle'] = 'rpt';
if($id > 0){
	$result = $db->fetchOne("select * from repertory where id='{$id}'");
	if($result){
		$img = get_img_from_db($result['img_id']);
		$data['avatar_src'] = RPT_RES_THUMB.get_full_url().'/'.$img['file'];
		$data['multi_image'] = get_imgs($id,'rpt');
		$data = array_merge($data,$result);
	}
}


render($data,'index');

<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'performance_add';
$data['js'][] = 'js/submit.js';
$id = getReqInt('id');
$data['rpt_select'] = get_rpt_select();
$data['multi_image_text'] = '演出剧照';
$data['single_image_text'] = '演出主图';
$data['multi_image_moudle'] = 'pfm';
if($id > 0){
	$result = $db->fetchOne("select * from performance where id='{$id}'");
	if($result){
		$img = get_img_from_db($result['img_id']);
		$data['avatar_src'] = PFM_RES_THUMB.get_full_url().'/'.$img['file'];
		$data['multi_image'] = get_imgs($id,'pfm');
		$data = array_merge($data,$result);
	}
}

render($data,'index');




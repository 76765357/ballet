<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'actor_add';
$data['js'][] = 'js/submit.js';
$id = getReqInt('id');
$type = 'actor';
$data['actor_cate_select'] = get_actor_cate_select();
$data['multi_image_text'] = '演员剧照';
$data['multi_image_moudle'] = $type;
$data['single_image_text'] = '头像';
$data['single_image_moudle'] = $type;
if($id > 0){
	$result = $db->fetchOne("select * from actor where id='{$id}'");
	if($result){
		$data['actor_cate_select'] = get_actor_cate_select($result['cid']);
		$img = get_img_from_db($result['avatar']);
		$data['avatar_src'] = ACTOR_RES_THUMB.'/'.$img['file'];
		$data['multi_image'] = get_imgs($id,'act');
		$data = array_merge($data,$result);
	}
}

//print_r($data);
render($data,'index');

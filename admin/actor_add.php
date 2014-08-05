<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'actor_add';
$data['js'][] = 'js/submit.js';
$id = getReqInt('id');
$data['actor_cate_select'] = get_actor_cate_select();
if($id > 0){
	$result = $db->fetchOne("select * from actor where id='{$id}'");
	if($result){
		$data['actor_cate_select'] = get_actor_cate_select($result['cid']);
		$img = get_img_from_db($result['avatar']);
		$data['avatar_src'] = ACTOR_RES_THUMB .$img['file'];
		$data['actor_image'] = get_actor_imgs($id);
		$data = array_merge($data,$result);
	}
}

//print_r($data);
render($data,'index');

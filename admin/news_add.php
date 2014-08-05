<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'news_add';
$data['js'][] = 'js/submit.js';
$id = getReqInt('id');
$data['multi_image_text'] = '新闻图片';
$data['single_image_text'] = '新闻概要图';
$data['multi_image_moudle'] = 'news';
$data['news_cate_select'] = get_news_cate_select();
if($id > 0){
	$result = $db->fetchOne("select * from news where id='{$id}'");
	if($result){
		$data['actor_cate_select'] = get_actor_cate_select($result['cid']);
		$img = get_img_from_db($result['avatar']);
		$data['avatar_src'] = ACTOR_RES_THUMB.get_full_url().'/'.$img['file'];
		$data['multi_image'] = get_imgs($id,'news');
		$data = array_merge($data,$result);
	}
}
render($data,'index');

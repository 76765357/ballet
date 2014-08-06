<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'news_add';
$data['js'][] = 'js/submit.js';
$type = 'news';
$id = getReqInt('id');
$data['single_image_text'] = '新闻概要图';
$data['single_image_moudle'] = $type;
$data['multi_image_text'] = '新闻图片';
$data['multi_image_moudle'] = $type;
$data['news_cate_select'] = get_news_cate_select();
if($id > 0){
	$result = $db->fetchOne("select * from news where id='{$id}'");
	if($result){
		$data['news_cate_select'] = get_news_cate_select($result['cate_id']);
		$img = get_img_from_db($result['img_id']);
		$data['avatar'] = $result['img_id'];
		$data['avatar_src'] = get_full_url().NEWS_RES_THUMB.$img['file'];
		$data['multi_image'] = get_imgs($id,$type);
		$data = array_merge($data,$result);
	}
}
render($data,'index');

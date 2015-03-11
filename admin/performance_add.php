<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'performance_add';
$data['js'][] = 'js/submit.js';
$id = getReqInt('id');
$type = 'pfm';
$data['rpt_select'] = get_rpt_select();
$data['multi_image_text'] = '演出剧照';
$data['multi_image_moudle'] = $type;
$data['single_image_text'] = '演出主图';
$data['single_image_moudle'] = $type;
$data['video_list'] = output_video_list();
$data['single_image_size'] = ' 图片尺寸 138*194';

if($id > 0){
	$result = $db->fetchOne("select * from performance where id='{$id}'");
	if($result){
		$pr = $db->fetchAll("select * from performance_repertory where pid='{$id}'");
		$prs = array();
		if($pr){
			foreach ($pr as $k => $v) {
				# code...
				$prs[] = $v['rid'];
			}
		}
		$data['rpt_select'] = get_rpt_select($prs);
		$img = get_img_from_db($result['img_id']);
		$data['avatar'] = $result['img_id'];
		$data['avatar_src'] = get_full_url() . PFM_RES_THUMB.$img['file'];
		$data['avatar_ori_src'] = get_full_url() . PFM_RES.$img['file'];
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




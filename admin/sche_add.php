<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data['action'] = 'sche_add';
$data['js'][] = 'js/submit.js';
$id = getReqInt('id');
$type = 'sche';
$data['single_image_text'] = '图片';
$data['single_image_moudle'] = $type;
$data['single_image_size'] = ' 图片尺寸 138*194';
#$data['rpt_select'] = get_rpt_select_one();
$data['rpt_select'] = get_rpt_select();

if($id > 0){
	$result = $db->fetchOne("select * from schedule where id='{$id}'");
	if($result){
                $pr = $db->fetchAll("select * from schedule_repertory where sid='{$id}'");
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
		$data['avatar_src'] = get_full_url() . SCHE_RES_THUMB . $img['file'];
		$data['avatar_ori_src'] = get_full_url() . SCHE_RES . $img['file'];

		$data = array_merge($data,$result);
	}
}
$db->close();
render($data,'index');

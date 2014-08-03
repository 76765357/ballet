<?php
/*
 * 所有表单入库集中在这里
*/
include_once dirname(__FILE__) . '/../' . 'init.php';

$tbname = v('tbname');
$name	= v('name');
$actor_cate = v('actor_cate');
$avatar = v('avatar');
$desc	= getReqHtml(v('desc'));
$rpt	= v('rpt');
$recommend = v('recommend');

$title = v('title');

switch ($tbname):
    case 'actor':
		$data = array(
			"name" 		=> $name,
			"avatar" 	=> $avatar,
			"desc" 		=> $desc,
			"recommend" => $recommend,
		);
			
		$db->insert($tbname,$data);
		$aid = $db->insertId();
		if(is_array($rpt)){
			foreach($rpt as $k=>$v){
				$data = array('aid'=>$aid,'mid'=>$v);
				$db->insert('actor_image',$data);
			}
		}
        break;
    case 'news':
		$data = array(
			"title"		=> $title,
			"description" 		=> $desc,
		);
			
		$db->insert($tbname,$data);
        break;
    case 2:
        echo "i equals 2";
        break;
    default:
        echo "i is not equal to 0, 1 or 2";
endswitch;

if($db->affectedRows() > 0){
	ajax_json(array('status'=>0,'msg'=>'success'));
}else{
	ajax_json(array('status'=>1,'msg'=>'failed'));
}

$db->close();

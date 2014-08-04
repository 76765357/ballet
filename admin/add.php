<?php
/*
 * 所有表单入库集中在这里
 * 多个页面可能有重合的字段，所以集中在一起复用变量名
 * 
*/
include_once dirname(__FILE__) . '/../' . 'init.php';

//操作表名
$tbname = v('tbname');

//名字
$name	= v('name');

//演员分类
$actor_cate = v('actor_cate');
//头像和头像描述
$avatar = v('avatar');
$avatar_desc = v('avatar_desc');
//大段文字说明
$desc	= getReqHtml(v('desc'));
//剧照和剧照描述
$rpt	= v('rpt');
$rpt_desc	= v('rpt_desc');
//是否为推荐 1：推荐 0：不推荐
$recommend = v('recommend');
//标题
$title = v('title');

//根据表名确定插入类型，有的可能要插入多张表
switch ($tbname):
	//插入的是演员
    case 'actor':
		$data = array(
			"name" 		=> $name,
			"avatar" 	=> $avatar,
			"desc" 		=> $desc,
			"recommend" => $recommend,
		);
			
		$db->insert($tbname,$data);
		$aid = $db->insertId();
		//剧照要单独保存
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

<?php
/*
 * 所有表单入库集中在这里
 * 多个页面可能有重合的字段，所以集中在一起复用变量名
 * 
*/
include_once dirname(__FILE__) . '/../' . 'init.php';

$id = v('id');
//操作表名
$tbname = v('tbname');

//名字
$name	= v('name');

//xx分类
$cid = v('cid');
//头像和头像描述
$avatar = v('avatar');
$avatar_desc = v('avatar_desc');
//大段文字说明
$desc	= (v('desc'));
$content	= (v('content'));
//剧照和剧照描述
$rpt	= v('rpt');
$rpt_desc	= v('rpt_desc');
//是否为推荐 1：推荐 0：不推荐
$recommend = v('recommend');
//标题
$title = v('title');
$subtitle = v('subtitle');
$time= v('time');
$price= v('price');
$phone= v('phone');
$addr= v('addr');
//演出包含的剧目
$rpts = v('rpts');

//根据表名确定插入类型，有的可能要插入多张表
switch ($tbname):
	//插入的是演员
    case 'actor':
		$data = array(
			"name" 		=> $name,
			"avatar" 	=> $avatar,
			"desc" 		=> $desc,
			"cid" 		=> $cid,
			"recommend" => $recommend,
		);
		if($id > 0){
			//do update
			$db->update($tbname,$data,"id={$id}");
			$aid = $id;
			
			//do clean 删掉剧照关系
			$db->delete('actor_image',"aid={$id}");
		}else{
			$db->insert($tbname,$data);
			$aid = $db->insertId();
		}
		
		//剧照要单独保存
		if(is_array($rpt)){
			foreach($rpt as $k=>$v){
				$data = array('aid'=>$aid,'mid'=>$v);
				$db->update('image',array("desc"=>$rpt_desc[$k]),"id={$v}");
				$db->insert('actor_image',$data);
			}
		}
        break;
    case 'news':
		$data = array(
			"title"		   => $title,
			"subtitle"     => $subtitle,
			"description"  => $desc,
			"img_id"    => $avatar,
			"cate_id" 		=> $cid,
		);
		if($id > 0){
			//do update
			$db->update($tbname,$data,"id={$id}");
			$aid = $id;
			
			//do clean 删掉剧照关系
			$db->delete('news_image',"nid={$id}");
		}else{
			$db->insert($tbname,$data);
			$aid = $db->insertId();
		}
		
		//剧照要单独保存
		if(is_array($rpt)){
			foreach($rpt as $k=>$v){
				$data = array('nid'=>$aid,'mid'=>$v);
				$db->update('image',array("desc"=>$rpt_desc[$k]),"id={$v}");
				$db->insert('news_image',$data);
			}
		}

        break;
    case 'repertory':
		$data = array(
			"title"         => $title,
			"subtitle"      => $subtitle,
			"desc"   		=> $desc,
			"img_id"        => $avatar,
			"time" 	    	=> $time,
			"price" 		=> $price,
			"phone" 		=> $phone,
			"addr" 			=> $addr,
		);
		if($id > 0){
			//do update
			$db->update($tbname,$data,"id={$id}");
			$aid = $id;
			
			//do clean 删掉剧照关系
			$db->delete('repertory_image',"rid={$id}");
		}else{
			$db->insert($tbname,$data);
			$aid = $db->insertId();
		}
		
		//剧照要单独保存
		if(is_array($rpt)){
			foreach($rpt as $k=>$v){
				$data = array('rid'=>$aid,'mid'=>$v);
				$db->update('image',array("desc"=>$rpt_desc[$k]),"id={$v}");
				$db->insert('repertory_image',$data);
			}
		}

        break;
     case 'performance':
		$data = array(
			"title"         => $title,
			"subtitle"      => $subtitle,
			"desc"   => $desc,
			"img_id"        => $avatar,
			"time" 	    	=> $time,
			"price" 		=> $price,
			"phone" 		=> $phone,
			"addr" 		=> $addr,
		);
		if($id > 0){
			//do update
			$db->update($tbname,$data,"id={$id}");
			$aid = $id;
			
			//do clean 删掉剧照关系、包含的剧目关系
			$db->delete('performance_image',"pid={$id}");
			$db->delete('performance_repertory',"pid={$id}");
		}else{
			$db->insert($tbname,$data);
			$aid = $db->insertId();
		}
		
		//剧照要单独保存
		if(is_array($rpt)){
			foreach($rpt as $k=>$v){
				$data = array('pid'=>$aid,'mid'=>$v);
				$db->update('image',array("desc"=>$rpt_desc[$k]),"id={$v}");
				$db->insert('performance_image',$data);
			}
		}

		//演出包含的剧目关系
		if(is_array($rpts)){
			foreach($rpts as $k=>$v){
				$data = array('pid'=>$aid,'rid'=>$v);
				$db->insert('performance_repertory',$data);
			}
		}
        break;
    case 'troupe':
		$data = array(
			"content"         => $content,
		);
		if($id > 0){
			//do update
			$db->update($tbname,$data,"id={$id}");
			$aid = $id;
			
			//do clean 删掉剧照关系
			$db->delete('troupe_image',"tid={$id}");
		}else{
			$db->insert($tbname,$data);
			$aid = $db->insertId();
		}
		
		//剧照要单独保存
		if(is_array($rpt)){
			foreach($rpt as $k=>$v){
				$data = array('tid'=>$aid,'mid'=>$v);
				$db->update('image',array("desc"=>$rpt_desc[$k]),"id={$v}");
				$db->insert('troupe_image',$data);
			}
		}

        break;
    default:
        echo "wrong add";
endswitch;

if($db->affectedRows() > 0){
	ajax_json(array('status'=>0,'msg'=>'success'));
}else{
	ajax_json(array('status'=>1,'msg'=>'failed'));
}

$db->close();

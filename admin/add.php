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
//演员职称，两三行
$profess =v('profess');
$avatar_desc = v('avatar_desc');
//大段文字说明
$desc	= (v('desc'));
//描述
$des	= (v('des'));
$content	= (v('content'));
//剧照和剧照描述
$rpt	= v('rpt');
$rpt_desc	= v('rpt_desc');
//是否为推荐 1：推荐 0：不推荐
$recommend = v('recommend');
//是否为保留剧目 1：保留 0：非保留
$reserve=v('reserve');
//推荐类别，1：新闻，2：视频 3：演出  4：剧目
$rcid=v('rcid');
//推荐id
$rid=v('rid');
//标题
$title = v('title');
$subtitle = v('subtitle');
$time= v('time');
$start_date = v('start_date');
$end_date= v('end_date');
$add_time= v('add_time');
$price= v('price');
$phone= v('phone');
$addr= v('addr');
//演出包含的剧目
$rpts = v('rpts');

//场次
$nop = v('nop');

$recom_reason= v('recom_reason');
//单个剧目id
$rpt_id= v('rpt_id');

$video_type = v('video_type');
$video_title = v('video_title');
$video_subtitle = v('video_subtitle');
$video_desc = v('video_desc');
$video_img = v('video_img');
$rec = v('rec');
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
			"recom_reason"	=>$recom_reason,
			"profess"	=> $profess,
			"des"		=> $des,
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
			"title"	   => $title,
			"subtitle"     => $subtitle,
			"description"  => $desc,
			"img_id"    => $avatar,
			"cate_id"	=> $cid,
			"des"		=> $des,
			"add_time" 	=> $add_time,
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
			"reserve"		=> $reserve,
			"des"		=> $des,
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

		if($video_type=='#select'){
			$vid = v('videoid');
			$data = array('vid' => $vid);
			$db->update($tbname,$data,"id={$aid}");
		}

		if($video_type=='#upload'){
			$vid = v('video');
			$data = array(
				'title'			=>	$video_title,
				'subtitle'		=>	$video_subtitle,
				'description'		=>	$video_desc,
				'image'			=>	$video_img
			);
			$db->update('video',$data,"id={$vid}");
			$data = array('vid' => $vid);
			$db->update($tbname,$data,"id={$aid}");

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
		
		if($video_type=='#select'){
			$vid = v('videoid');
			$data = array('vid' => $vid);
			$db->update($tbname,$data,"id={$aid}");
		}

		if($video_type=='#upload'){
			$vid = v('video');
			$data = array(
				'title'			=>	$video_title,
				'subtitle'		=>	$video_subtitle,
				'description'		=>	$video_desc,
				'image'			=>	$video_img
			);
			$db->update('video',$data,"id={$vid}");
			$data = array('vid' => $vid);
			$db->update($tbname,$data,"id={$aid}");

		}

		/*if($vid > 0){
			$data = array(
				'title'			=>	$video_title,
				'subtitle'		=>	$video_subtitle,
				'description'	=>	$video_desc,
				'image'			=>	$video_img
			);
			$db->update('video',$data,"id={$vid}");
			$data = array('vid' => $vid);
			$db->update($tbname,$data,"id={$aid}");
		}
		*/
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
    case 'recommend':
    	
    	$result = $db->fetchOne("select * from recommend where rid={$rid} and cid={$rcid}");
    	if(!$result){
    		$data = array('rid'=> $rid,'cid'=> $rcid,'type'=>$rec);
    		$db->insert($tbname,$data);
    	}else{
    		//0不推荐1推荐2主推荐
    		$data = array('type'=>$rec);
    		$db->update($tbname, $data, "rid={$rid} and cid={$rcid}");
    	}
    	

    	break;
    case 'schedule':
		$data = array(
			"title"	=> $title,
			"start_date"	=> $start_date,
			"end_date"	=> $end_date,
			"addr" 	=> $addr,
			"rpt_id" => $rpt_id,
			"nop"	=> $nop,
			"img_id"    => $avatar,
			"phone"		=> $phone,
			"price"		=> $price,
		);
		if($id > 0){
			//do update
			$db->update($tbname,$data,"id={$id}");
			$aid = $id;
		}else{
			$db->insert($tbname,$data);
			$aid = $db->insertId();
		}
    	break;
    case 'audi':
		$data = array(
			"trust"    => v('trust'),
		);
		if($id > 0){
			//do update
			$db->update($tbname,$data,"id={$id}");
		}
    	break;
    case 'config':
		if(v('ctype') == 'theme-color'){
			$data = array(
				"cvalue"    => v('cvalue'),
			);
			if($id > 0){
				//do update
				$db->update($tbname,$data,"id=1");
			}
		}
    	break;

    case 'push':
                $data = array(
                        "title" => $title,
                        "detail"  => $desc,
                        "img"    => $avatar,
                );
                if($data)
		{
                        $db->insert($tbname,$data);
                        $aid = $db->insertId();
                }

	break;
    case 'video':
		$videoid= v('video');
                $data = array(
                        "title" => $video_title,
                        "subtitle" => $video_subtitle,
                        "description"  => $video_desc,
                        "image"    => $video_img,
                );
                if($videoid > 0){
			$db->update($tbname,$data,"id={$videoid}");
                        $aid = $db->insertId();
                }
	break;


    default:
        echo "wrong add";
endswitch;
$db->close();
ajax_json(array('status'=>0,'msg'=>'success'));
exit;
if($db->affectedRows() > 0){
	ajax_json(array('status'=>0,'msg'=>'success'));
}else{
	ajax_json(array('status'=>1,'msg'=>'failed'));
}



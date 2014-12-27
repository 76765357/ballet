<?php
header("Content-type:application/json");
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$msg = t(v('message'));
$token = t(v('token'));

if($msg == '' || $token ==''){
	$r = array('success'=>'false','result'=>array('msg'=>'请输入留言和token'));
	ajax_json($r);
}

$user = $db->fetchOne("select * from audi where token='{$token}'");
if(!$user){
	$r = array('success'=>'false','result'=>array('msg'=>'用户不存在'));
	ajax_json($r);
}

/*
去重逻辑,暂时不加了
$old = $db->fetchOne("select * from message where message='{$msg}' and token='{$token}'");
if($old){
	$r = array('success'=>'false','result'=>array('msg'=>''));
	ajax_json($r);
}*/
$messg = array(
		'msg'=>$msg,
		'uid'=>$user['id'],
		'uname'=>$user['name'],
		'avatar'=>$user['avatar'],
		'phone'=>$user['phone'],
	);
$result = $db->insert('message',$messg);
if($result){
	$r = array('success'=>'true');
}else{
	$r = array('success'=>'false');
}
ajax_json($r);

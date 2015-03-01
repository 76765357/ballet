<?php
header("Content-type:application/json");
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$phone = t(v('usrid'));//手机号
$pwd= t(v('password'));
$token= t(v('token'));
if($token != ''){
	$user = $db->fetchOne("select * from audi where token='{$token}'");
}else if($phone != '' && $pwd !=''){
	$user = $db->fetchOne("select * from audi where phone='{$phone}' and password='{$pwd}'");
}else{
	$r = array('success'=>'false','result'=>array('msg'=>'请传入用户名和密码或者token'));
	ajax_json($r);
}
if(!$user){
	$r = array('success'=>'false','result'=>array('msg'=>'用户不存在或密码错误'));
}else{
	$r = array(	
		'success'=>'true',
		'result'=>array(
				'token'=>$user['token'],
				'usrinfo'=>array(
					'avatar'=>$user['avatar'],
					'email'=>$user['email'],
					'id'=>$user['id'],
					'phone'=>markPhone($user['phone']),
					'usrname'=>$user['name'],
				)
		)
	);
}
ajax_json($r);

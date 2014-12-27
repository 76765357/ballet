<?php
header("Content-type:application/json");
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$mod = t(v('mod'));
$token = t(v('token'));
if(!$token || !$mod){
	$r = array('success'=>'false','result'=>array('msg'=>'请传入mod和token参数'));
	ajax_json($r);
}
$table = 'audi';
if($mod == 'phone'){
	$phone = t(v('phone'));
	$originphone = t(v('originphone'));
	$info = array(
		'phone' => $phone,
		);
}else if($mod == 'pwd'){
	$password = t(v('password'));
	$info = array(
		'password' => $password,
		);
}else if($mod == 'userinfo'){
	$avatar = t(v('avatar'));
	$email = t(v('email'));
	$usrname = t(v('usrname'));
	$info = array(
		'avatar' => $avatar,
		'email' => $email,
		'name' => $usrname,
		);
}else{
	$r = array('success'=>'false','result'=>array('msg'=>'未知的mod'));
	ajax_json($r);
}
$where = "token='{$token}'";
$db->update($table,$info,$where);
$user = $db->fetchOne("select * from audi where token='{$token}'");
$r = array(	
	'success'=>'true',
	'result'=>array(
			'token'=>$user['token'],
			'usrinfo'=>array(
				'avatar'=>$user['token'],
				'email'=>$user['email'],
				'id'=>$user['id'],
				'phone'=>markPhone($user['phone']),
				'usrname'=>$user['name'],
			)
	)
);
ajax_json($r);

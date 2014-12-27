<?php
header("Content-type:application/json");
include_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."init.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."conf.php";
$phone = t(v('phone'));
$email = t(v('email'));
$pwd= t(v('password'));
$name= t(v('usrname'));
$token = mtok($phone);
$audi = array(
		'phone'=>$phone,
		'email'=>$email,
		'password'=>$pwd,
		'name'=>$name,
		'token'=>$token
);
$isExist= $db->fetchOne("select id from audi where phone='{$phone}'");
if($isExist){
	$r = array('success'=>'false','result'=>array('msg'=>'手机号已被注册'));
}else{
	$result = $db->insert('audi',$audi);
	$uid = $db->insertId();
	$r = array(	
			'success'=>'true',
			'result'=>array(
					'token'=>$token,
					'usrinfo'=>array(
						'avatar'=>'',
						'email'=>$email,
						'id'=>$uid,
						'phone'=>markPhone($phone),
						'usrname'=>$name,
					)
			)
		);
}
ajax_json($r);

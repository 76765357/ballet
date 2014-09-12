<?php
include_once dirname(__FILE__) . '/../' . 'init.php';

$data['action'] = 'performance';
$sql = "select * from performance order by id desc";
$result = $db->fetchAll($sql);
foreach ($result as $key => $value) {
    # code...
    $type = $db->fetchSclare("select type from recommend where cid=3 and rid=".$value['id']);
    $result[$key]['type'] = $type;
}
$data['result'] = $result;
$data['yesno'] = $yesno;
//$data['actor_cate'] = get_actor_cate();
render($data,'index');  

<?php
include_once dirname(__FILE__) . '/../' . 'init.php';

$data['action'] = 'schedule';
$sql = "select * from schedule";
$result = $db->fetchAll($sql);
foreach ($result as $key => $value) {
    # code...
    $title = $db->fetchSclare("select title from repertory where id=".$value['rpt_id']);
    $result[$key]['rpt_name'] = $title;
}
$data['result'] = $result;
render($data,'index');  

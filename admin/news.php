<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$cate	= v('cate');
$data['action'] = 'news';
$sql = "select * from news where cate_id={$cate} order by id desc";
$result = $db->fetchAll($sql);
foreach ($result as $key => $value) {
    # code...
    $type = $db->fetchSclare("select type from recommend where cid=1 and rid=".$value['id']);
    $result[$key]['type'] = $type;
}
$data['result'] = $result;
$data['news_cate'] = get_news_cate();
render($data,'index');

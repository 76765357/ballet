<?php
include_once dirname(__FILE__) . DS . 'init.php';

//数据库用法参考 DB.class.php
$actor = $db->fetchOne("select * from actor;");
print_r($actor);

$actor = $db->fetchAll("select * from actor;");
print_r($actor);

$actor = $db->query("show create table actor;");
var_dump($actor);

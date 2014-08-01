<?php
include_once dirname(__FILE__) . '/../' . 'init.php';
$data = array();
$data['action'] = t(v('action'));
render($data,'index');

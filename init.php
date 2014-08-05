<?php
/**
 * @name init.php
 * @desc 文件初始化设置,包含此目录包需要的文件及变量声明
 * @author  wanglong
 * @updatetime 
 */

//error_reporting(E_ALL | E_STRICT);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set( 'display_errors' , true );
ini_set( 'magic_quotes_gpc' , false );
ini_set('short_open_tag','On');
// 常量
define( 'IN' , true );
define( 'DS' , '/' );
define( 'ROOT' , dirname( __FILE__ ) . DS );
define( 'TROOT' , dirname( __FILE__ ) . DS . 'admin/template'. DS  );
//define( 'CROOT' , ROOT . 'core' . DS  );
//define( 'AROOT' , ROOT . 'app' . DS  );

include dirname(__FILE__) . DS .'core/const.inc.php';
include dirname(__FILE__) . DS .'core/function.inc.php';
include dirname(__FILE__) . DS .'config.php';
include dirname(__FILE__) . DS .'class/Mysql.class.php';
include dirname(__FILE__) . DS .'class/DB.class.php';

$_GET = transcribe( $_GET );
$_POST = transcribe( $_POST );
$_REQUEST = transcribe( $_REQUEST );

$CACHE = array();


$CACHE['db']['default']['master'] = $DB_CONCFIG;

$db = DB::getInstance('default', true);
$data = array();
//上传图片相关js
$data['js'][] = '../vender/jquploader/js/vendor/jquery.ui.widget.js';
$data['js'][] = '../vender/jquploader/js/jquery.iframe-transport.js';
$data['js'][] = '../vender/jquploader/js/jquery.fileupload.js';
$data['js'][] = '../vender/h5form/h5form.js';
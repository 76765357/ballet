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
include dirname(__FILE__) . DS .'class/Mysql.class.php';
include dirname(__FILE__) . DS .'class/DB.class.php';

$_GET = transcribe( $_GET );
$_POST = transcribe( $_POST );
$_REQUEST = transcribe( $_REQUEST );

$CACHE = array();

$DB_CONCFIG = array(
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'database' => 'cnballet',
    );

$CACHE['db']['default']['master'] = $DB_CONCFIG;

$db = DB::getInstance('default', true);


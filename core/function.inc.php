<?php
/**
 * @name function.inc.php
 * @desc 通用函数库,只有全局都需要使用的方法才可以放到这里
 * @author 
 * @createtime 
 * @updatetime 
 * 
 */
if(!defined('WL')) exit('Illegal Request');

function v( $str )
{
        return isset( $_REQUEST[$str] ) ? $_REQUEST[$str] : false;
}

function z( $str )
{
        return strip_tags( $str );
}

function c( $str )
{
        return isset( $GLOBALS['config'][$str] ) ? $GLOBALS['config'][$str] : false;
}

function l( $str )
{
        return isset( $GLOBALS['lang'][$str] ) ? $GLOBALS['lang'][$str] : false;
}


function g( $str )
{
        return isset( $GLOBALS[$str] ) ? $GLOBALS[$str] : false;        
}

function gg( $str )
{
        return isset( $_GET[$str] ) ? $_GET[$str] : false;
}

function e($message = null,$code = null) 
{
        throw new Exception($message,$code);
}

function s($str,$db = null,$type = 'LZ_DB_SLAVER')
{
        if($db == null) {
                if(@is_resource($GLOBALS['db']['default'][$type])) {
                        $db = $GLOBALS['db']['default'][$type];
                } else {
                        $dbr = new db_Mysql();
                        $db = $dbr->db();
                }
        }
        return "'".mysql_real_escape_string($str,$db)."'";
}

function t( $str )
{
        return trim($str);
}

// session management
function ss( $key )
{
        return isset( $_SESSION[$key] ) ?  $_SESSION[$key] : false;
}

function ss_set( $key , $value )
{
        return $_SESSION[$key] = $value;
}

// render functiones
function renderbak( $data = NULL , $layout = 'default' )
{
        if (is_debug()) return $data;
        $GLOBALS['layout'] = $layout;
        $layout_file = AROOT . 'view/index.tpl.html';
        if( file_exists( $layout_file ) )
        {
                @extract( $data );
                require( $layout_file );
        }
        else
        {
                $layout_file = CROOT . 'view/index.tpl.html';
                if( file_exists( $layout_file ) )
                {
                        @extract( $data );
                        require( $layout_file );
                }
        }
}

// render functiones
function render( $data = NULL , $layout = 'default' )
{
    $layout_file = TROOT . $layout.'.tpl.html';
    if( file_exists( $layout_file ) ){
            @extract( $data );
            require( $layout_file );
    }
}

function transcribe($aList, $aIsTopLevel = true)
{
   $gpcList = array();
   $isMagic = get_magic_quotes_gpc();

   foreach ($aList as $key => $value) {
       if (is_array($value)) {
           $decodedKey = ($isMagic && !$aIsTopLevel)?stripslashes($key):$key;
           $decodedValue = transcribe($value, false);
       } else {
           $decodedKey = stripslashes($key);
           $decodedValue = ($isMagic)?stripslashes($value):$value;
       }
       $gpcList[$decodedKey] = $decodedValue;
   }
   return $gpcList;
}

/**
 * @name getEndTime
 * @desc 计算执行页面所需时间函数
 * @param string $msg 附加信息
 * @return string
 * @author 
 * @createtime 2014-07-19
 **/
function getEndTime($msg = '')
{
	return $msg . (microtime() - YEPF_BEGIN_TIME);
}
/**
 * @name getClientIp
 * @desc 获得客户端ip
 * @return  string client ip
 * @author 
 * @createtime 2014-07-19
 */
function getClientIp()
{
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
		$onlineip = getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
		$onlineip = getenv('REMOTE_ADDR');
	} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
		$onlineip = $_SERVER['REMOTE_ADDR'];
	}
	return $onlineip;
}
/**
 * @name redirect
 * @desc 跳转函数
 * @param string $url 跳转的url
 * @return void
 * @author 
 * @createtime 2014-07-19
 **/
function redirect($url)
{
	if(!empty($url))
	{
		header("Location: ".$url."");
	}
	exit;
}
/**
 * @name cutstr
 * @desc 按照指定的规则切分字符串,针对UTF8. $length 为你要显示的汉字 * 3
 * @param string $string	原始字符串
 * @param int $length	切割的长度
 * @param string $suffix	后缀名
 * @return string 
 * @author 
 * @createtime 2014-07-19
 */
function cutstr($string, $length, $suffix = '')
{
	$p	=	0;
	$j	=	0;
	if($string == "")
	{
		return "";
	}
	preg_match_all('/([x41-x5a,x61-x7a,x30-x39])/', $string, $letter); //字母
	$string_len = strlen($string);
	$let_len = count($letter[0]);
	if($string_len == $let_len)
	{
		//没有汉字
		$len = floor($length / 2);
		if($string_len > $len)
			return substr($string, 0, $len) . $suffix;
		else 
			return substr($string, 0, $len);
	}
	$length_tmp	=	($string_len - $let_len * 2) + $let_len * 2;
	if($length_tmp > $length)
	{
		for ($k=0;$k<=($length-3);$k++)
		{
			$j++;
			if($j	>	($length-3))
			{
				break;
			}
			if (ord(substr($string,$k,1)) >= 129)
			{
				$k+=2;
				$j+=2;
			}
			else
			{
				$p++;
			}
			if($p	==	2)
			{
				$j++;
				$p	=	0;
			}
		}
		$string = substr($string, 0, $k);
	}
	$string	=	str_replace("<BR…","<BR>…",$string);
	$string	=	str_replace("<B…","<BR>…",$string);
	$string	=	str_replace("<…","<BR>…",$string);
	
	if($string_len > strlen($string))
		return $string . $suffix;
	else 
		return $string;
}

/**
 * @name yaddslashes
 * @desc 转义定符串函数
 * @param string $string
 * @return mixed
 * @author 
 * @createtime 2014-07-19
 */
function yaddslashes($string)
{
	if(!get_magic_quotes_gpc())
	{
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = yaddslashes($val);
			}
		} else {
			$string = addslashes($string);
		}
	}
	return $string;
}
/**
 * @name getFormHash
 * @desc 生成防止跨站攻击(XSS)的字串
 * @author  
 * @param string $addstring 字串的附加码.建议为用户ID
 * @createtime 2009-04-13 08:23
 */
function getFormHash($addstring = '')
{
	static $hash ;
	if(empty($hash))
	{
		$domain = defined('ROOT_DOMAIN') ? ROOT_DOMAIN : '' ;
		$clientip = getClientIp();
		$hash = substr(md5(YEPF_PATH . '_' . $domain . '_' . $clientip . '_' . $addstring), 0, 12);
	}
	return $hash ;
}
/**
 * @name getReqInt
 * @desc 接收用户输入值-整型
 * @author 
 * @param string $name	变量的名称
 * @param string $method  接收方式：GET & POST & REQUEST 
 * @param int $default	默认值
 * @param int $min	最小值
 * @param int $max	最大值
 * @createtime 2009-04-13 17:32
 */
function getReqInt($name, $method = 'REQUEST', $default = 0, $min = false, $max = false)
{
	$method = strtoupper($method);
	switch ($method)
	{
		case 'POST':
			$variable = $_POST;
			break;
		case 'GET':
			$variable = $_GET;
			break;
		default:
			$variable = $_REQUEST;
			break;
	}
	if(!isset($variable[$name]) || $variable[$name] == '')
	{
		return $default ;
	}
	$value = intval($variable[$name]) ;
	if($min !== false)
	{
		$value = max($value, $min);
	}
	if($max !== false)
	{
		$value = min($value, $max);
	}
	return $value;
}
/**
 * @name getReqHtml
 * @desc 接收用户输入值-带html,需要php tidy支持
 * @author 
 * @param string $name	变量的名称
 * @param string $method	接收方式：GET & POST & REQUEST
 * @param string $default	默认值
 * @param string $type 		格式化的类型,目前支持reply及content.详细请参见HtmlFilter.class.php
 */
function getReqHtml($name, $method = 'REQUEST', $default = '', $type = 'content')
{
	$method = strtoupper($method);
	switch ($method)
	{
		case 'POST':
			$variable = $_POST;
			break;
		case 'GET':
			$variable = $_GET;
			break;
		default:
			$variable = $_REQUEST;
			break;
	}
	if(!isset($variable[$name]))
	{
		return $default ;
	}
	$htmlfilter_obj = new HtmlFilter($type);
	$mytidy = $htmlfilter_obj->repair($variable[$name]);
	return $htmlfilter_obj->filter($mytidy);
}
/**
 * @name getReqNoHtml
 * @desc 接收用户输入值-不带Html
 * @param string $name	变量的名称
 * @param string $method	接收方式：GET & POST & REQUEST
 * @param string $default	默认值
 */
function getReqNoHtml($name, $method = 'REQUEST', $default = '')
{
	$method = strtoupper($method);
	switch ($method)
	{
		case 'POST':
			$variable = $_POST;
			break;
		case 'GET':
			$variable = $_GET;
			break;
		default:
			$variable = $_REQUEST;
			break;
	}
	if(!isset($variable[$name]))
	{
		return $default ;
	}
	return trim(strip_tags($variable[$name]));
}

	
/**
 * 解析xml，返回Array形式的数据
 * @param String $strXml XML的内容
 * @author 
 * @return Array XML节点的数据，数组形式返回
 */
function getXmlData($strXml) {
	$pos = strpos($strXml, 'xml');
	if ($pos) {
		$xmlCode = simplexml_load_string($strXml,'SimpleXMLElement', LIBXML_NOCDATA);
		$arrayCode = get_object_vars_final($xmlCode);
		return $arrayCode ;
	} else {
		return '';
	}
}

/**
 * 获取XML文档对象的数据
 * @param simplexml $obj XML文档对象
 * @author 
 * @return Array 节点的数据
 */
function get_object_vars_final($obj){
	if(is_object($obj)){
		$obj=get_object_vars($obj);
	}
	
	if(is_array($obj)){
		foreach ($obj as $key=>$value){
			$obj[$key] = get_object_vars_final($value);
		}
	}
	return $obj;
}

function wwrite($fname,$neirong,$moshi=wb){
	touch($fname);
	$opentxt=fopen($fname,$moshi);
	flock($opentxt,LOCK_EX);
	fwrite($opentxt,$neirong);
	fclose($opentxt);
}

function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0;
        return
            ($https ? 'https://' : 'http://').
            (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
            ($https && $_SERVER['SERVER_PORT'] === 443 ||
            $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
            substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
    }

function ajax_json($data){
	echo json_encode($data);
	exit;
}

function get_actor_cate(){
	global $db;
	$sql = "select * from actor_cate";
	$result = $db->fetchAll($sql);
	$return = array();
	if($result) {
		foreach($result as $k=>$v){
				$return[$v['id']]['name'] = $v['name'];	
				$return[$v['id']]['desc'] = $v['desc'];	
		}
		return $return;
	}else{
		return false;
	}
}

function get_actor_cate_select(){
	$data = get_actor_cate();
	if($data){
		$html = '<select name="actor_cate">';
		foreach($data as $k=>$v){
			$html .= "<option value='{$k}'>{$v['name']}</option>";
		}
		$html .= '</select>';
		return $html;
	}else{
		return 'no actor cate data';
	}
}

function get_news_cate(){
	global $db;
	$sql = "select * from news_cate";
	$result = $db->fetchAll($sql);
	$return = array();
	if($result) {
		foreach($result as $k=>$v){
				$return[$v['id']]['name'] = $v['name'];	
				$return[$v['id']]['desc'] = $v['desc'];	
		}
		return $return;
	}else{
		return false;
	}
}

function get_news_cate_select(){
	$data = get_news_cate();
	if($data){
		$html = '<select name="news_cate">';
		foreach($data as $k=>$v){
			$html .= "<option value='{$k}'>{$v['name']}</option>";
		}
		$html .= '</select>';
		return $html;
	}else{
		return 'no news cate data';
	}
}
?>

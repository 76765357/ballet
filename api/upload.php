<?php
#print_r($_FILES);
$url=get_full_url();
list($year,$mon,$day,$now) = explode(" ", date("Y m d YmdHis", time()));
$base_dir=dirname(dirname(__FILE__))."/attachment/img/avatar/";
$fileinfo=pathinfo($_FILES["file"]["name"]);
$basename=$now.rand(100,999).".".$fileinfo['extension'];
$filename=$base_dir.$basename;
$fileurl=dirname($url)."/attachment/img/avatar/$basename";

if ((($_FILES["file"]["type"] == "image/gif")||($_FILES["file"]["type"] == "image/png")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/pjpeg"))&& ($_FILES["file"]["size"] < 10000000))
{
	if ($_FILES["file"]["error"] > 0)
        {
        	$result['sucess']="false";
                $result['result']=$_FILES["file"]["error"];
                echo json_encode($result);
        }else{

                move_uploaded_file($_FILES["file"]["tmp_name"], $filename);
                $result['sucess']="true";
                $result['result']['avatar']=$fileurl;
                echo json_encode($result);
             }
        }else{
                $result['sucess']="false";
                $result['result']='Invalid file';
                echo json_encode($result);
        }



function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0;
	#$script=substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
	#$script=substr($script,0,strrpos($script, '/'));
        return
            ($https ? 'https://' : 'http://').
            (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
            ($https && $_SERVER['SERVER_PORT'] === 443 ||
            $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
	    substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
}


?>

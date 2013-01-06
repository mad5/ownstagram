<?php
define('projectPath', dirname(__FILE__));
error_reporting(-1);ini_set('display_errors', 'on');

include_once 'resources/inc.common.php';
$settings = $own->getSettings();

$res = array("result" => 0);
switch($_REQUEST['action']) {
	case 'version' : 
			$res = array("result" => 1, "version" => $own->VERSION);
			break;
	case 'comment' :
			$res = $own->addComment($_REQUEST['id'], $_REQUEST['comment']);
			break; 	
	case 'register' :
			$res = $own->register($_REQUEST['email'], $_REQUEST['password']);
			break; 	
	case 'login' :
			$res = $own->login($_REQUEST['email'], $_REQUEST['password']);
			break; 	
	case 'logout' :
			$res = $own->logout();
			break; 	
	case 'upload' :
			$res = $own->uploadapp();
			break; 	
	case 'setting' :
			$res = $own->savesetting();
			break; 	
	case 'sitesettings':
			if(me()<=0 || getS('user', 'u_email')!=ownStaGramAdmin) {
				$res=array("result" => 0);
			} else {
				$res = $own->setSettings();
			}
			break;
	default: 
			$res = array("result" => 0, "error" => "API-Command unknown!");
}

if(isset($_GET['callback'])) {
	echo $_GET['callback']."(".json_encode($res).");";
} else {
	echo json_encode($res);
}

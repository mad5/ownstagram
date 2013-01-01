<?php
define('projectPath', dirname(__FILE__));
error_reporting(-1);ini_set('display_errors', 'on');

include_once 'resources/inc.common.php';
$settings = $own->getSettings();

$res = array("result" => 0);
switch($_POST['action']) {
	case 'comment' :
			$res = $own->addComment($_POST['id'], $_POST['comment']);
			break; 	
	case 'register' :
			$res = $own->register($_POST['email'], $_POST['password']);
			break; 	
	case 'login' :
			$res = $own->login($_POST['email'], $_POST['password']);
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

}

echo json_encode($res);

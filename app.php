<?php
header("Access-Control-Allow-Origin: *");
define('projectPath', dirname(__FILE__));
#error_reporting(-1);ini_set('display_errors', 'on');
error_reporting(0);ini_set('display_errors', 'off');

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
	case 'getimagedetails':
			$res = $own->getimagedetails($_REQUEST['id']);
			break;
	case 'setstar':
			$res = $own->setStar($_REQUEST['id'], (int)$_REQUEST['star']);
			break;
	case 'rotate':
			$res = $own->rotate($_REQUEST['id'], (int)$_REQUEST['rotation']);
			break;
	case 'register' :
			$res = $own->register($_REQUEST['nickname'], $_REQUEST['email'], $_REQUEST['password']);
			break; 	
	case 'forgot' :
			$res = $own->forgot($_REQUEST['email']);
			break; 	
	case 'login' :
			$res = $own->login($_REQUEST['email'], $_REQUEST['password']);
			if($res['result']==1 && isset($_REQUEST['remotekey']) && $_REQUEST['remotekey']!='') {
				$res = $own->loginAtRemote($_REQUEST['remotekey'], $_REQUEST['remoteserver']);
			}
			break; 	
	case 'loginfromremote':
			$data = json_decode($_REQUEST['data'], true);
			$res = array("result" => 0);
			if(stristr($data['key'],'.') || stristr($data['key'],'/')) die('error...');
			if(file_exists(projectPath.'/data/cache/'.$data['key'].'.rlogin')) {
				$key2 = md5($data['key'].microtime(true));
				$res = array("result" => 2, "key" => $key2);
				$fn = projectPath.'/data/cache/'.$key2.'.rlogin';
				file_put_contents($fn, $_REQUEST['data']);
			}
			break;
	case 'logout' :
			$res = $own->logout();
			break; 	
	case 'upload' :
			$res = $own->uploadapp();
			break; 	
	case 'listgallery' :
			$res = $own->listgallery($_REQUEST['email'], $_REQUEST['password']);
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
	case 'remotelogin':
			$rl = glob(projectPath.'/data/cache/*.rlogin');
			for($i=0;$i<count($rl);$i++) {
				if(filemtime($rl[$i])<time()-60*5) {
					unlink($rl[$i]);
				}
			}
			$key = md5($_POST['server'].microtime(true));
			file_put_contents(projectPath.'/data/cache/'.$key.'.rlogin', $_POST['server']);
			
			$S = $own->getServerUrl();
			$res = array("result" => 1, "key" => $key, "server" => $S );
				
			break;
	case 'twitterconnect':
			$res = $own->twitterconnect();
			break;
	case 'socialpost':
			$res = $own->socialpost();
			break;
	case 'addemailin':
			$res = $own->addemailin();
			break;
	case 'checkemailin':
			if(isset($_REQUEST['uid'])) {
				$res = $own->checkemailinForUser($_REQUEST['uid']);
			} else {
				$res = $own->checkemailin();
			}
			break;
	case 'removeEIkey':
			$res = $own->removeEIkey($_POST['email']);
			break;
	default: 
			$res = array("result" => 0, "error" => "API-Command unknown!");
}

if(isset($_GET['callback'])) {
	echo $_GET['callback']."(".json_encode($res).");";
} else {
	echo json_encode($res);
}

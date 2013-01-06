<?php
define('projectPath', dirname(__FILE__));
error_reporting(-1);ini_set('display_errors', 'on');
include_once 'resources/inc.common.php';

$settings = $own->getSettings();

$tpl = new template();
$tpl->setVariable($settings);

$tplContent = new template();
$tplContent->setVariable($settings);


$html = '';
if(!isset($_GET['action'])) $_GET['action'] = '';
switch($_GET['action']) {
	case 'image' :
			$W = (int)$_GET["w"];if($W<10) $W = 100;
			$im = imageCreateTrueColor($W,$W);
			$img = $own->findImage($_GET['img']);
			$orig = imageCreateFromJpeg(projectPath.'/data/'.$img['i_file']);
			
			$wh = imageSx($orig);
			if(imageSy($orig)<$wh) $wh = imageSy($orig);
			
			//imagecopyresampled ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )
			imagecopyresampled($im, $orig, 0,0, imageSx($orig)/2-$wh/2, imageSy($orig)/2-$wh/2, $W, $W, $wh, $wh);
			header("content-type: image/jpeg");
			imageJpeg($im, NULL, 90);
			exit;
			break;
	case 'newuser':
		if(me()<=0 || getS('user', 'u_email')!=ownStaGramAdmin) jump2();
		if(isset($_POST["saveuser"]) && $_POST["saveuser"]==1) {
			$own->setUserData(-1, $_POST['FORM']);
			header("location: index.php?action=users");
			exit;
		}
		
		$tplContent->setVariable("view", "edit");
		$html = $tplContent->get('tpl.users.php');
		
		break;
		
	case 'users':
		if(me()<=0 || getS('user', 'u_email')!=ownStaGramAdmin) jump2();
		if(isset($_GET['id']) && (int)$_GET["id"]>0) {
			if(isset($_POST["saveuser"]) && $_POST["saveuser"]==1) {
				$own->setUserData((int)$_GET["id"], $_POST['FORM']);
				header("location: index.php?action=users");
				exit;
			}
			$edit = $own->getUserData((int)$_GET["id"]);
			$tplContent->setVariable("view", "edit");
			$tplContent->setVariable($edit);
		} else {
			$list = $own->getUserList();
			for($i=0;$i<count($list);$i++) {
				$list[$i]["pictures"] = (int)$own->picturesForUser($list[$i]["u_pk"]);
			}
			$tplContent->setVariable("view", "list");
			$tplContent->setVariable("list", $list);
		}
		
		$html = $tplContent->get('tpl.users.php');
		break;
		
	case 'newgroup':
		if(me()<=0) jump2();
		if(isset($_POST["savegroup"]) && $_POST["savegroup"]==1) {
			$own->setGroupData(-1, $_POST['FORM']);
			header("location: index.php?action=groups");
			exit;
		}
		
		$tplContent->setVariable("view", "edit");
		$html = $tplContent->get('tpl.groups.php');
		
		break;
		
	case 'groups':
		if(me()<=0) jump2();
		if(isset($_GET['id']) && (int)$_GET["id"]>0) {
			if(isset($_POST["savegroup"]) && $_POST["savegroup"]==1) {
				$own->setGroupData((int)$_GET["id"], $_POST['FORM']);
				header("location: index.php?action=groups");
				exit;
			}
			$edit = $own->getGroupData((int)$_GET["id"]);
			$tplContent->setVariable("view", "edit");
			$tplContent->setVariable($edit);
		} else {
			$list = $own->getGroupList();
			for($i=0;$i<count($list);$i++) {
				$list[$i]["pictures"] = (int)$own->picturesForGroups($list[$i]["g_pk"]);
			}
			$tplContent->setVariable("view", "list");
			$tplContent->setVariable("list", $list);
		}
		
		$html = $tplContent->get('tpl.groups.php');
		break;
		
		
	case 'confirmed':
		$html = $tplContent->get('tpl.register_confirm.php');
		break;
	case 'confirm':
		$own->confirm();
		break;
	case 'thanks':
		$tplContent->setVariable("res", (int)$_GET['res']);
		$html = $tplContent->get('tpl.register_thanks.php');
		break;
	case 'register':
		$html = $tplContent->get('tpl.register.php');
		break;
	
	case 'login':
		$html = $tplContent->get('tpl.login.php');
		break;
	
	case 'overview':
		if(me()<=0) jump2();
			
		$list = $own->getList(me());
		$tplContent->setVariable("list", $list);
		$html = $tplContent->get('tpl.overview.php');
		break;
	
	case 'delete':
		if(me()<=0) jump2();
		$data = $own->getDetail($_GET['id']);
		if(me()>0 && $data['i_u_fk']==me()) {
			$own->delete($data);
			header("location: index.php?action=overview");
			exit;
		} else {
			die("no access!");
		}
		
	case 'detail':
		if(isset($_POST['savesettings']) && $_POST['savesettings']==1) {
			$own->updateDetails($_GET['id'], $_POST);
		}
		$data = $own->getDetail($_GET['id']);
		
		if($data['i_public']==-1 && me()!=$data['i_u_fk']) {
			die('No access to this picture!');
			exit;
		}
			
		if(me()>0 && me()!=$data['i_u_fk'] && getS('user', 'u_email')!=ownStaGramAdmin) {
			$own->hitPhoto(me(), $data);
		}
		
		if(me()>0 && me()==$data['i_u_fk']) {
			$next = $own->getNextImages($data);
			$prev = $own->getPrevImages($data);
			$tplContent->setVariable("next", $next);
			$tplContent->setVariable("prev", $prev);
		}
		
		$comments = $own->getComments($data['i_pk']);
		$tplContent->setVariable($data);
		$tplContent->setVariable("comments", $comments);
		$tplContent->setVariable("id", $_GET['id']);
		
		$imgsrc = $own->getScaled($data['i_file'], 500,500);
		$tplContent->setVariable("imgsrc", $imgsrc);
		
		$groups = $own->getGroupList();
		$tplContent->setVariable("groups", $groups);
		
		$tpl->setVariable("detailtitle", $data['i_title']." @ ");
		
		$html = $tplContent->get('tpl.detail.php');
		break;
	
	case 'upload':
		if(me()<=0) jump2();
		if(isset($_POST['upload']) && $_POST['upload']==1) {
			
			$res = $own->upload($_FILES, me());
			$id = $res['id'];
			header("location: index.php?action=detail&id=".$id);
			exit;
		}
		$html = $tplContent->get('tpl.upload.php');
		break;
	case 'settings':
		if(me()<=0 || getS('user', 'u_email')!=ownStaGramAdmin) {
			jump2();
		}
		$S = $own->getSettings();
		$tplContent->setVariable($S);
		$html = $tplContent->get('tpl.settings.php');
		
		break;
	default: $html = $tplContent->get('tpl.home.php');
		 break;
}


$tpl->setVariable('CONTENT', $html);

$html = $tpl->get('tpl.main.php');
echo $html;

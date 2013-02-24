<?php
if(!file_Exists(dirname(__FILE__).'/inc.var.php')) {
	echo "to run ownStaGram follow these few steps:<br/><br/>";
	echo "1) create a new database and set user permissions.<br/><br/>";
	echo "2) rename <i>inc.var.php.dist</i> to <i>inc.var.php</i> and set database-credentials.<br/><br/>";
	echo "3) change line <i>define('ownStaGramAdmin', 'mailSender@example.com');</i> to your prefered email-address.<br/><br/>";
	echo "4) make data-folder writable for apache/php.<br/><br/>";
	echo "5) reload this page and register with the emailaddress you set as ownStaGramAdmin.<br/><br/>";
	exit;
}

define('projectPath', dirname(__FILE__));
#error_reporting(-1);ini_set('display_errors', 'on');
error_reporting(-1);ini_set('display_errors', 'on');
include_once 'resources/inc.common.php';

if(isset($_GET['O'])) {
	$_REQUEST["action"] = $_GET["action"] = "detail";
	$_REQUEST["id"] = $_GET["id"] = $_GET["O"];
}

$settings = $own->getSettings();

$tpl = new template();
$tpl->setVariable($settings);

$tplContent = new template();
$tplContent->setVariable($settings);

if(isset($_GET['id'])) $_GET['id'] = str_replace("/", "", $_GET['id']);

$html = '';
if(!isset($_GET['action'])) $_GET['action'] = '';
switch($_GET['action']) {
	case 'image' :
			$W = (int)$_GET["w"];if($W<10) $W = 100;
			$im = imageCreateTrueColor($W,$W);
			
			imagesavealpha($im, false);
			
			$black = imageColorAllocate ($im, 0,0,0);
			$transparent = imagecolortransparent( $im, $black );
			imagefilledRectangle( $im, 0, 0, imageSx($im), imageSy($im), $transparent ); 

			$img = $own->findImage($_GET['img']);
			$ext = strtolower(substr(projectPath.'/data/'.$img['i_file'], strrpos(projectPath.'/data/'.$img['i_file'],".")));
			if($ext==".jpg" || $ext==".png") {
				$orig = imageCreateFromString(file_get_contents(projectPath.'/data/'.$img['i_file']));
			/*} else if($ext==".png") {
				$orig = imageCreateFromPng(projectPath.'/data/'.$img['i_file']);
			*/} else die("Wrong extension.");
			
			
			$wh = imageSx($orig);
			if(imageSy($orig)<$wh) $wh = imageSy($orig);
			
			if($img['i_set']>0 && isset($_GET['set'])) {
				imagecopyresampled($im, $orig, 0+$W/8,0+$W/8, imageSx($orig)/2-$wh/2, imageSy($orig)/2-$wh/2, $W-$W/4, $W-$W/4, $wh, $wh);
			} else {
				imagecopyresampled($im, $orig, 0,0, imageSx($orig)/2-$wh/2, imageSy($orig)/2-$wh/2, $W, $W, $wh, $wh);
			}
			
			if((int)$img['i_rotation']!=0) $im = imagerotate($im, $img['i_rotation']*(-90), 0);

			if($img['i_set']>0 && isset($_GET['set'])) {
				$stack = imageCreateFromPng(projectPath.'/resources/stack.png');
				imagecopyresampled($im, $stack, 0,0, 0, 0, $W, $W, imageSx($stack), imageSy($stack));
			}
			
			if(me()!=$img['i_u_fk']) $own->addWatermark($im);
			
			if($img['i_set']>0 && isset($_GET['set'])) {
				header("content-type: image/png");
				imagePng($im);
			} else {
				header("content-type: image/jpeg");
				imageJpeg($im, NULL, 90);
			}
			exit;
			break;
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
		
		
	case 'info':
		$html = $tplContent->get('tpl.info.php');
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
	case 'rlogin':
		$own->rlogin($_GET['key']);
		break;
	case 'login':
		if(me()>0 && isset($_REQUEST['remotekey']) && $_REQUEST['remotekey']!='') {
			$own->user = getS("user");
			$res = $own->loginAtRemote($_REQUEST['remotekey'], $_REQUEST['remoteserver']);
			if($res['result']==2) {
				header("location: ".$_REQUEST['remoteserver']."?action=rlogin&key=".$res['key']);
				exit;
			}
		}

		$html = $tplContent->get('tpl.login.php');
		break;
	case 'forgot':
		$html = $tplContent->get('tpl.forgot.php');
		break;
	
	case 'overview':
		if(me()<=0) jump2();
			
		if(isset($_POST['changeset']) && $_POST['changeset']==1) {
			if((int)$_POST['set']==-1) {
				$_POST['set'] = 0;
				if(trim($_POST['newsetname'])!='') {
					$_POST['set'] = $own->newset($_POST['newsetname']);
				}
			}
			for($i=0;$i<count($_POST['ids']);$i++) {
				$detail = $own->getDetail($_POST['ids'][$i]);
				if($detail!="" && $detail['i_u_fk']==me()) {
					$new = array(
						'i_set' => (int)$_POST['set']
					);
					if(isset($_POST['public']) && $_POST['public']!=-999) {
						$new['i_public'] = (int)$_POST['public'];
					}
					if(isset($_POST['newdate']) && $_POST['newdate']!="") {
						$new['i_date'] = date("Y-m-d", strtotime($_POST['newdate']));
					}
					$own->DC->update($new, "ost_images", $detail["i_pk"], "i_pk");
				}
			}
		}
		
		$filter = "";
		if(isset($_GET['filter']) && $_GET['filter']=='fav') $filter = $_GET["filter"];
		if( getS('user', 'u_remoteserver')=='') { 
			$list = $own->getList(me(), $filter);
		} else {
			$list = $own->getCollected(me());
		}
		$tplContent->setVariable("list", $list);

		$sets = $own->getSetList();
		$tplContent->setVariable("sets", $sets);
		
		$html = $tplContent->get('tpl.overview.php');
		break;
	
	case 'discover':
		$list = $own->getPublics(me(), 100, 'i_pk DESC');
		$tplContent->setVariable("list", $list);
		$html = $tplContent->get('tpl.discover.php');
		break;
	case 'discoverglobal':
		$list = $own->getPublicRemotes(100);
		$tplContent->setVariable("list", $list);
		$html = $tplContent->get('tpl.discoverglobal.php');
		break;
	
	case 'discoverflickr':
		$rss = file_get_contents('http://api.flickr.com/services/feeds/photos_public.gne');
		$rss = str_nach($rss, '<entry>');
		$entry = explode('</entry>', $rss);
		$list = array();
		for($i=0;$i<count($entry)-1;$i++) {
			$L = array();
			$L['gi_title'] = str_zwischen($entry[$i], '<title>', '</title>');
			$L['gi_date'] = str_zwischen($entry[$i], '<published>', '</published>');
			$L['gl_url'] = str_zwischen($entry[$i], '<published>', '</published>');
			$L['gl_content'] = htmlspecialchars_decode(str_zwischen($entry[$i], '<content type="html">', '</content>'));
			$L['gl_content'] = str_replace('<a href', '<a target=_blank href', $L['gl_content']);
			$list[] = $L;
		}
		$tplContent->setVariable("list", $list);
		$html = $tplContent->get('tpl.discoverflickr.php');
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
		break;
	case 'detailglobal':
		
		$data = $own->getDetailGlobal($_GET['id']);
		$tpl->setVariable("detailtitle", $data['gi_title']." @ ");
		
		$tplContent->setVariable($data);
		$tplContent->setVariable("imgsrc", $data['gl_host'].'/index.php?action=image&img='.$data['gi_imgid'].'&w=500');
		
		$html = $tplContent->get('tpl.detailglobal.php');
		break;
	case 'detail':
		if(isset($_POST['savesettings']) && $_POST['savesettings']==1) {
			$own->updateDetails($_GET['id'], $_POST);
		}
		$data = $own->getDetail($_GET['id']);
		
		if($data['i_public']==-1 && me()!=$data['i_u_fk']) {
			die('No access to this picture!');
			exit;
		}
			
		$own->hitPhoto(me(), $data);
		
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
		
		$watermark = ($data['i_u_fk']!=me());
		if($data['i_public']==0 && me()>0) $watermark = false; 
		$imgsrc = $own->getScaled($data['i_file'], 500,10000, $data['i_rotation'], $data['i_square'], $watermark  );
		$tplContent->setVariable("imgsrc", $imgsrc);
		
		$groups = $own->getGroupList();
		$tplContent->setVariable("groups", $groups);

		$sets = $own->getSetList();
		$tplContent->setVariable("sets", $sets);
		
		$tpl->setVariable("detailtitle", $data['i_title']." @ ");
		
		if($data['i_set']>0) {
			$setimages = $own->getOtherSetImages($data['i_set']);
			$tplContent->setVariable("setname", $setimages[0]['se_name']);
			$tplContent->setVariable("setimages", $setimages);
		} else {
			$forthis = $own->getOthers($data['i_u_fk']);
			$tplContent->setVariable("forthis", $forthis);
		
			$others = $own->getPublics($data['i_u_fk']);
			$tplContent->setVariable("others", $others);			
		}
		
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
		
		$groups = $own->getGroupList();
		$tplContent->setVariable("groups", $groups);
		$sets = $own->getSetList();
		$tplContent->setVariable("sets", $sets);
		
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
	case 'profile':
		if(me()<=0) {
			jump2();
		}
		if(isset($_POST['send']) && $_POST['send']==1) {
			$own->setProfile($_POST);
		}
		
		if(isset($_POST['sendemailin']) && $_POST['sendemailin']==1 && isset($_POST['emailins'])) {
			$own->updateSendmailins($_POST['emailins']);
			
		}
		
		$P = $own->getProfile();
		$tplContent->setVariable($P);
		
		$EI = $own->getEmailin();
		$tplContent->setVariable("emailin", $EI);
		
		$html = $tplContent->get('tpl.profile.php');
		
		break;
	default:
		$public = $own->getPublics(0,50);
		$tplContent->setVariable("public", $public);

		$html = $tplContent->get('tpl.home.php');
		break;
}


$tpl->setVariable('CONTENT', $html);

$html = $tpl->get('tpl.main.php');
echo $html;

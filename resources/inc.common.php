<?php
session_start();

include_once dirname(__FILE__).'/class.template.php';
include_once 'inc.var.php';
include_once dirname(__FILE__).'/class.db.php';

function vd($X) {
	echo "<pre>";
	print_r($X);
	echo "</pre>";
}

function me() {
	return getS("user", "u_pk");
}
function now() {
	return date("Y-m-d H:i:s");
}
function setS($name, $value) {
	$_SESSION[$name] = $value;
}
function getS($name, $field="") {
	if(!isset($_SESSION[$name])) return "";
	if($field!="") {
		if(!isset($_SESSION[$name][$field])) return "";
		return $_SESSION[$name][$field];
	}
	return $_SESSION[$name];
}
function jump2($action='') {
	header("location: index.php?action=".$action);
	exit;
}

class ownStaGram {
	public $DC;
	public $VERSION = "1.7.4";
	public function __construct() {
		$this->DC = new DB(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_CHARACTERSET);
		if($this->DC->res!=1) {
			echo "<hr/>";
			echo("error connecting to database...");
			echo "<hr/>";
			exit;
		}
		
		if(!file_exists(projectPath.'/data')) {
			mkdir(projectPath.'/data', 0775);
			chmod(projectPath.'/data', 0775);
		}
		if(!file_exists(projectPath.'/data/cache')) {
			mkdir(projectPath.'/data/cache', 0775);
			chmod(projectPath.'/data/cache', 0775);
		}
		
		if(!is_writable(projectPath.'/data')) {
			echo "<hr/>";
			echo("data-folder not writable!");
			echo "<hr/>";
			exit;
		}
		if(!is_writable(projectPath.'/data/cache')) {
			echo "<hr/>";
			echo("data/cache-folder not writable!");
			echo "<hr/>";
			exit;
		}
		
		if(!file_exists(projectPath.'/data/index.html')) {
			touch(projectPath.'/data/index.html');
		}
		if(!file_exists(projectPath.'/data/cache/index.html')) {
			touch(projectPath.'/data/cache/index.html');
		}
		
	}
	
	public function getProfile() {
		$Q = "SELECT * FROM ost_user WHERE u_pk='".me()."' ";
		$P = $this->DC->getByQuery($Q);
		return $P;
	}
	public function setProfile($post) {
		$U = array(
				"u_nickname" => htmlspecialchars($post['u_nickname']),
				"u_country" => htmlspecialchars($post['u_country']),
				"u_city" => htmlspecialchars($post['u_city']),
			);
		$this->DC->update($U, "ost_user", me(), "u_pk");
	}
	
	public function getSettings() {
		$Q = "SELECT * FROM ost_settings";
		$S = $this->DC->getByQuery($Q);
		if($S=="") $S['s_allowregistration']=1;
		return $S;
	}
	
	public function setSettings() {
		$S = $this->getSettings();
		$data = array("s_subtitle" => $_POST["setting_title"],
			      "s_title" => $_POST["setting_maintitle"],
			      "s_allowregistration" => $_POST["setting_allow_register"],
			      "s_allowfriendsstreams" => $_POST["setting_allow_upload"] 
			      );
		#vd($S);
		#vd($data);
		if(isset($S['s_pk'])) {
			$this->DC->update($data, 'ost_settings', $S['s_pk'], 's_pk');
		} else {
			$this->DC->insert($data, 'ost_settings');
		}
		$res = array("result" => 1);
		return $res;
	}
	public function confirm() {
		$Q = "SELECT * FROM ost_user WHERE md5(concat('skfbvwezguzjndcbv76qwdqwef', u_email, u_password))='".addslashes($_GET['id'])."' ";
		$user = $this->DC->getByQuery($Q);
		if($user=="") die("Error!");
		
		$this->DC->sendQuery("UPDATE ost_user SET u_confirmed=now() WHERE u_confirmed='0000-00-00 00:00:00' AND u_pk='".(int)$user['u_pk']."' ");
		$this->login($user['u_email'], $user['u_password']);
		header('location: index.php?action=confirmed');
		exit;
	}
	
	public function register($email, $pass) {

		$C = $this->DC->countByQuery("SELECT count(*) FROM ost_user WHERE lcase(u_email)='".strtolower(addslashes($email))."' ");
		if($C>0) {
			$res = array("result" => 0);
			return $res;
		}
		
		$data = array('u_email' => $email,
				'u_password' => $pass,
				'u_registered' => now()
				);
		if(ownStaGramAdmin==$email) {
			$data["u_confirmed"] = now();
		}
		
		$this->DC->insert($data, 'ost_user');

		if(ownStaGramAdmin==$email) {
			$res = array("result" => 2);
		} else {
	
			$M = "You registered at ".$_SERVER['HTTP_HOST']." for an ownStaGram-account.\n";
			$M .= "Follow this link to confirm your registration.\n\n";
			
			$M .= "http://".$_SERVER['HTTP_HOST'].str_replace("app.php", "index.php", $_SERVER["PHP_SELF"])."?action=confirm&id=".md5('skfbvwezguzjndcbv76qwdqwef'.$email.$pass);
			mail($email, "ownStaGram - Registration", $M, "FROM:".ownStaGramAdmin);
			$res = array("result" => 1);
		}
		
		
		return $res;
	}
	public function login($email, $pass) {
		$this->user = $user = $this->DC->getByQuery("SELECT * FROM ost_user WHERE u_email='".addslashes($email)."' AND u_password='".addslashes($pass)."' AND u_confirmed!='0000-00-00 00:00:00' ");
		if($user!="") {
			setS("user", $user); 
			$res = array("result" => 1);
			setCookie('ownStaGram', md5('sdkfb2irzsidfz8edtfwuedfgwjehfwje'.$this->user['u_pk']), time()+60*60*24*365);
		} else {
			$res = array("result" => 0);
		}
		return $res;
	}
	public function loginCookie($key) {
		$this->user = $user = $this->DC->getByQuery("SELECT * FROM ost_user WHERE md5(concat('sdkfb2irzsidfz8edtfwuedfgwjehfwje', u_pk))='".addslashes($key)."' AND u_confirmed!='0000-00-00 00:00:00' ");
		if($user!="") {
			setS("user", $user); 
			$res = array("result" => 1);
		} else {
			$res = array("result" => 0);
		}
		return $res;
	}
	public function logout() {
		setS("user", "");
		setCookie('ownStaGram', '', time()+60*60*24*365);
		$res = array("result" => 1);
		return $res;
	}
	
	public function uploadapp() {
		$res = $this->login($_POST['email'], $_POST["password"]);
		if($res["result"] == 1) {
			$u_pk = $this->user["u_pk"];
			$path = (int)$u_pk.'/'.date('Ymd');
			if(!file_exists('data/'.$path)) {
				mkdir('data/'.$path, 0777, true);
				chmod('data/'.$path, 0777);
			}
			$fn = $path.'/'.microtime(true).'.jpg';
			
			$M = $_POST["img"];
			$M= str_replace(" ", "+", $M);
			$M = base64_decode($M);
			file_put_contents("data/".$fn, $M);
			
			$data = array('i_u_fk' => (int)$u_pk,
				'i_date' => now(),
				'i_file' => $fn
			);
			$pk = $this->DC->insert($data, 'ost_images');
			
			$G = $this->getGroupList();
			$G2 = array();
			for($i=0;$i<count($G);$i++) {
				$G2[] = array("gid" => $G[$i]["g_pk"],
						"name" => $G[$i]["g_name"]
						);
			}
			
			$res = array("result" => 1, "id" => md5($fn.$pk.$data['i_date']), "imgid" => md5($data['i_date'].$data['i_file']), "groups" => $G2 );
			return $res;
		}
	}
	
	public function savesetting() {
		$data = $this->getDetail($_POST['ownid']);
		if($data!="") {
			$S = array("i_public" => (int)$_POST['public'],
				   "i_title" => htmlspecialchars(stripslashes($_POST['title'])),
				   "i_g_fk" => (int)$_POST["group"],
				   "i_lat" => $_POST["lat"],
				   "i_lng" => $_POST["lng"],
				   "i_location" => $_POST["location"],
				   );
			$this->DC->update($S, "ost_images", $data['i_pk'], 'i_pk');
			$res = array("result" => 1);
		} else {
			$res = array("result" => 0);
		}
		return $res;
	}
	
	public function upload($files, $u_pk) {
		
		$path = (int)$u_pk.'/'.date('Ymd');
		if(!file_exists('data/'.$path)) {
			mkdir('data/'.$path, 0777, true);
			chmod('data/'.$path, 0777);
		}
		$fn = $path.'/'.microtime(true).'.jpg';
		move_uploaded_file($files['img']['tmp_name'], 'data/'.$fn);
		
		$data = array('i_u_fk' => (int)$u_pk,
				'i_date' => now(),
				'i_file' => $fn,
				'i_title' => htmlspecialchars(stripslashes($_POST['title'])),
				'i_public' => (int)$_POST['public']
			);
		$pk = $this->DC->insert($data, 'ost_images');
		
		$res = array("result" => 1, "id" => md5($fn.$pk.$data['i_date']));
		return $res;
		                             
	}
	
	public function delete($data) {
		unlink('data/'.$data["i_file"]);
		$this->DC->sendQuery("DELETE FROM ost_images WHERE i_pk='".(int)$data['i_pk']."' ");
	}
	
	public function getScaled($fn, $w, $h) {
		
		if(rand(0,100)>80) $this->unlinkOld();
		
		$W = (int)$w;if($W<10) $W = 100;
		$H = (int)$h;if($H<10) $H = 100;
		$im = imageCreateTrueColor($W,$H);
		$orig = imageCreateFromJpeg(projectPath.'/data/'.$fn);
		
		$wh = imageSx($orig);
		if(imageSy($orig)<$wh) $wh = imageSy($orig);
		$cn = 'data/cache/'.md5($fn.$w.$h).".jpg";
		imagecopyresampled($im, $orig, 0,0, imageSx($orig)/2-$wh/2, imageSy($orig)/2-$wh/2, $W, $H, $wh, $wh);
		imageJpeg($im, projectPath.'/'.$cn, 90);
		return $cn;
		
	}
	public function unlinkOld() {
		$G = glob(projectPath.'/data/cache/*.jpg');
		for($i=0;$i<count($G);$i++) {
			if(filemtime($G[$i])<time()-60*60*24*30) {
				if(file_Exists($G[$i]) && is_file($G[$i])) unlink($G[$i]);
			}
		}
	}

	public function getDetail($id) {
		$data = $this->DC->getByQuery("SELECT *,md5(concat(i_file,i_pk,i_date)) as id FROM ost_images WHERE md5(concat(i_file,i_pk,i_date))='".addslashes($id)."' ");
		return $data;
	}
	public function updateDetails($id, $data) {
		$detail = $this->getDetail($id);
		if($detail['i_u_fk']!=me()) die("no access!");
		$new = array(
				'i_title' => htmlspecialchars(stripslashes($data['title'])),
				'i_public' => (int)$data['public'],
				'i_g_fk' => (int)$data['group']
				);
		$this->DC->update($new, "ost_images", $detail["i_pk"], "i_pk");
	}
	public function hitPhoto($u_fk, $data) {
		$Q = "SELECT * FROM ost_views WHERE v_u_fk='".(int)$u_fk."' AND v_i_fk='".(int)$data["i_pk"]."' ";
		$V = $this->DC->getByQuery($Q);
		if($V=="") {
			$V = array("v_u_fk" => (int)$u_fk,
				   "v_i_fk" => (int)$data['i_pk'],
				   "v_date" => date("Y-m-d H:i:s")
				   );
			$this->DC->insert($V, "ost_views");
		}
	}
	
	public function picturesForUser($u_pk) {
		$Q = "SELECT count(*) FROM ost_images WHERE i_u_fk='".(int)$u_pk."' ";
		return $this->DC->countByQuery($Q);
	}
	
	public function picturesForGroups($g_pk) {
		$Q = "SELECT count(*) FROM ost_images WHERE i_g_fk='".(int)$g_pk."' ";
		return $this->DC->countByQuery($Q);
	}
	
	public function getList($from) {
		$data = $this->DC->getAllByQuery("SELECT *, md5(concat(i_file,i_pk,i_date)) as id FROM ost_images WHERE i_u_fk='".(int)$from."' ORDER BY i_date DESC ");
		for($i=0;$i<count($data);$i++) {
			$data[$i]["views"] = $this->DC->countByQuery("SELECT count(*) FROM ost_views WHERE v_i_fk='".(int)$data[$i]["i_pk"]."'  ");
			$data[$i]["comments"] = $this->DC->countByQuery("SELECT count(*) FROM ost_comments WHERE co_i_fk='".(int)$data[$i]["i_pk"]."'  ");
		}
		return $data;
	}
	public function getNextImages($data) {
		$Q = "SELECT *,md5(concat(i_file,i_pk,i_date)) as id FROM ost_images WHERE i_u_fk='".$data["i_u_fk"]."' AND i_date>'".$data["i_date"]."' ORDER BY i_date LIMIT 3";
		$D = $this->DC->getAllByQuery($Q);
		$D = array_reverse($D);
		return $D;
	}
	public function getPrevImages($data) {
		$Q = "SELECT *,md5(concat(i_file,i_pk,i_date)) as id FROM ost_images WHERE i_u_fk='".$data["i_u_fk"]."' AND i_date<'".$data["i_date"]."' ORDER BY i_date DESC LIMIT 3";
		$D = $this->DC->getAllByQuery($Q);
		return $D;
	}
	public function getComments($i_pk) {
		$Q = "SELECT * FROM ost_comments
			INNER JOIN ost_user ON u_pk=co_u_fk
			WHERE co_i_fk='".(int)$i_pk."' ORDER BY co_date";
		$data = $this->DC->getAllByQuery($Q);
		return $data;
	}
	public function addComment($id, $comment) {
		$data = $this->getDetail($id);
		if($data["i_pk"]>0) {
			$C = array("co_i_fk" => $data["i_pk"],
				   "co_u_fk" => me(),
				   "co_date" => now(),
				   "co_comment" => htmlspecialchars(stripslashes($comment))
				);
			$this->DC->insert($C, "ost_comments");
			$res = array("result" => 1);
			return $res;
		}
	}
	public function findImage($img) {
		$Q = "SELECT * FROM ost_images WHERE md5(concat(i_date,i_file))='".addslashes($img)."' ";
		$img = $this->DC->getByQuery($Q);
		return $img;
	}
	
	public function getUserList($page=0) {
		//$pp = 20;
		$Q = "SELECT * FROM ost_user ORDER BY u_email "; // LIMIT ".$page.",".$pp;
		$U = $this->DC->getAllByQuery($Q);
		return $U;
	}
	public function getUserData($u_pk) {
		$Q = "SELECT * FROM ost_user WHERE u_pk='".(int)$u_pk."' ";
		$data = $this->DC->getByQuery($Q);
		return $data;
	}
	public function setUserData($u_pk, $data) {
		$user = array("u_email" => $data["email"]);
		if($data['password']!="" && $data['password']==$data['password2']) {
			$user["u_password"] = md5('a4916ab01df010a042c612eb057b4ac23e79530d555354c4a92e1b24301b964f0f7ecd66143c4093ea1470efcfa33042'.$data['password']);
		}
		if(isset($data['confirm'])) $user['u_confirmed '] = now();
		else $user['u_confirmed '] = "0000-00-00 00:00:00";
		if($u_pk==-1) {
			$user["u_registered"] = now();
			$this->DC->insert($user, "ost_user");
		} else {
			$this->DC->update($user, "ost_user", $u_pk, "u_pk");
		}
	}
	
	
	
	public function getGroupList($page=0) {
		//$pp = 20;
		$Q = "SELECT * FROM ost_groups WHERE g_u_fk='".me()."' ORDER BY g_name "; // LIMIT ".$page.",".$pp;
		$U = $this->DC->getAllByQuery($Q);
		return $U;
	}
	public function getGroupData($g_pk) {
		$Q = "SELECT * FROM ost_groups WHERE g_pk='".(int)$g_pk."' AND g_u_fk='".me()."' ";
		$data = $this->DC->getByQuery($Q);
		return $data;
	}
	public function setGroupData($g_pk, $data) {
		$group = array("g_name" => $data["groupname"], "g_u_fk" => me());
		if($g_pk==-1) {
			$this->DC->insert($group, "ost_groups");
		} else {
			$GD = $this->getGroupData($g_pk);
			if($GD["g_u_fk"]!=me()) die("no access!");
			$this->DC->update($group, "ost_groups", $g_pk, "g_pk");
		}
	}	
	
	public function getPublics($u_pk=0) {
		$Q = "SELECT *,md5(concat(i_file,i_pk,i_date)) as id FROM ost_images WHERE i_public=1 ";
		$Q .= " AND i_u_fk!='".(int)$u_pk."' ";
		$Q .= " ORDER BY rand() LIMIT 20 ";
		$I = $this->DC->getAllByQuery($Q);
		return $I;
	}
	public function getOthers($u_pk, $limit=20) {
		$Q = "SELECT *,md5(concat(i_file,i_pk,i_date)) as id FROM ost_images WHERE i_public=1 AND i_u_fk='".(int)$u_pk."' ORDER BY rand() LIMIT ".(int)$limit;
		$I = $this->DC->getAllByQuery($Q);
		return $I;
	}
	
}

$own = new ownStaGram();

$update_fn = projectPath.'/data/cache/update.log';
$doUpdate = false;
if(!file_exists($update_fn)) $doUpdate = true;
else if(filemtime($update_fn)<filemtime(projectPath.'/resources/inc.update.php')) $doUpdate = true;
if($doUpdate == true) {
	touch($update_fn);
	include_once(dirname(__FILE__).'/inc.update.php');
}

if(me()<=0) {
	if(isset($_COOKIE['ownStaGram']) && $_COOKIE['ownStaGram']!='') {
		$own->loginCookie($_COOKIE['ownStaGram']);
	}
	
}

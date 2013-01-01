<?php
class DB {
	// {{{
	public $host;
	public $user;
	public $pass;
	public $link;
	public $name;
	public $res;
	public $data;
	public $characterset;
	public $develop=false;
	public function __construct($host, $user, $pass, $name, $characterset) {
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->name = $name;
		$this->characterset = $characterset;
		$this->link = mysql_pconnect($this->host, $this->user, $this->pass);
		unset($this->pass);
		
		if($this->characterset!="") {
			$this->setCharaterSet($this->characterset);
		}
		
		return $this->res = mysql_select_db($this->name, $this->link );
	}
	
	function setCharaterSet($cs) {
		mysql_query('SET character_set_results = '.$cs, $this->link);
		mysql_query('SET character_set_client = '.$cs, $this->link);
		mysql_query("SET NAMES '".$cs."'", $this->link);
	}
	
	function close(){
		return $this->res = mysql_close($this->link);
	}
	function sendQuery($str){
		return $this->query($str);
	}
	function query($str){
		
		if($this->develop) {
			try {
				throw new Exception;
			} catch(Exception $e) {
				 $T = $e->getTrace();
				 if(stristr($T[1]['file'],'/modul/') && !stristr($T[1]['file'],'/classes/')) {
					
					 echo "<span style='color:red;font-weight:bold;'>";
					 echo "used direct databasecall in:<br>".$T[1]['file']."<br>at line ".$T[1]['line'];
					 exit;
				 }
			}
		}

		#$T = microtime(true);
		$res = $this->res = mysql_query($str, $this->link);
		if ($this->develop && mysql_errno()) {
			try {
				throw new Exception;
			} catch(Exception $e) {
				 $T = $e->getTrace();
			}
			die("MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$str\n<br><pre>".print_r($T,1)."</pre>");
		}
		if(!stristr($str, 'LAST_INSERT_ID')) $this->lastQuery = $str;
		#$T = microtime(true)-$T;
		#if($_SERVER['REMOTE_ADDR']=="192.168.1.81") addLog(number_format($T,4)."\t".$str);
		return $res;
	}
	function fetch(){
		return $this->data = mysql_fetch_assoc($this->res);
	}
	function fetchAll(){
		$data = array();
		while ($this->data = mysql_fetch_assoc($this->res)) {
			$data[] = $this->data;
		}
		return $data;
	}
	function countByQuery($query) {
		// {{{
		$this->query($query);
		$this->data = $this->fetch();
		foreach($this->data as $key => $value) {
			return($value);
		}
		
		// }}}
	}
	function getByQuery($query, $feld="") {
		// {{{
		$this->query($query);
		$this->data = $this->fetch();
		if($feld!="") return($this->data[$feld]);
		return($this->data);
		// }}}
	}
	function getAllByQuery($query, $justField='') {
		// {{{
		$this->query($query);
		$this->data = $this->fetchAll();
		if($justField!='') {
			$D = array();
			for($i=0;$i<count($this->data);$i++) {
				// {{{
				$D[] = $this->data[$i][$justField];
				// }}}
			}
			return($D);
		}
		return($this->data);
		// }}}
	}
	function setDbTable($table) {
		// {{{
		$this->DBTable = $table;
		// }}}
	}
	
	function insert($data, $table="") {
		// {{{
		
		if($table=="") $table = $this->DBTable;

		reset ($data);
		$QN = "";
		$QV = "";
		while (list ($key, $val) = each ($data)) {
			if($QN!="") $QN .= ",";
			$QN .= $key;
			if($QV!="") $QV .= ",";
			if(substr($val,0,9)=="password(") {
				$QV .= $val;
			} else {
				$QV .= "'".addslashes($val)."'";
			}
		}
		$q = "INSERT INTO $table ($QN) VALUES ($QV)";
		//vd($q);
		$this->query($q);
		
		$pk = $this->lastID();
		return($pk);
		// }}}
	}

	function update($data, $table, $pk, $pk_field="") {
		// {{{
		
		if($pk_field=="") {
			$pk_field = $pk;
			$pk = $table;
			$table = $this->DBTable;
		}

		reset ($data);
		$Q = "";
		while (list ($key, $val) = each ($data)) {
			if($Q!="") $Q .= ",";
			$Q .= $key."=";
			if(substr($val,0,9)=="password(") {
				$Q .= $val;
			} else {
				$Q .= "'".addslashes($val)."'";
			}
		}
		$q = "UPDATE $table SET $Q  WHERE $pk_field='$pk' ";
		
		$this->query($q);
		// }}}
	}

	function matchArrayWithTable($array, $table) {
		// Hier fehlt noch das matichng
		return $array;
	}

	function lastID() {
		// {{{
		$q = "SELECT LAST_INSERT_ID() as LID";
		$X = $this->getByQuery($q);
		$lastId = $X["LID"];
		return($lastId);
		// }}}
	}
	function DB_error($DB){
		if (!$DB->res){
			return die('Ung�ltige Abfrage: ' . mysql_error());
		}
	}
	
	function getAllFields($table) {
		// {{{
		$q = 'DESCRIBE '.$table;
		$f = $this->getAllByQuery($q);
		return($f);
		// }}}
	}
	function fieldExists($table, $field) {
		// {{{
		$f = $this->getAllFields($table);
		for($i=0;$i<count($f);$i++) {
			// {{{
			if($f[$i]['Field']==$field) return(true);
			// }}}
		}
		return(false);
		// }}}
	}

	function getAllTables() {
		// {{{
		$q = 'SHOW TABLES';
		$f = $this->getAllByQuery($q);
		#vd($f);
		$k = array_keys($f[0]);
		
		$T = array();
		for($i=0;$i<count($f);$i++) {
			// {{{
			$T[] = $f[$i][$k[0]];
			// }}}
		}
		return($T);
		// }}}
	}
	function tableExists($table) {
		// {{{
		$T = $this->getAllTables();
		#vd($T);
		for($i=0;$i<count($T);$i++) {
			// {{{
			#vd(array($T[$i] == $table, $T[$i] ,$table));
			if($T[$i] == $table) return(true);
			// }}}
		}
		return(false);
		// }}}
	}
	// }}}
}
// }}}

class DBDebug extends DB {
	// {{{
	function query($str){
		$T0 = microtime(true);
		$this->res = mysql_query($str, $this->link);
		$T1 = microtime(true)-$T0;
		if($T1>0.05) {
			$str = str_replace("\n", ' ', $str);
			$str = str_replace("\r", ' ', $str);
			$str = str_replace("\t", ' ', $str);
			
			addFile(projectPath.'/db.log', date('d.m.Y H:i:s')."\t".number_format($T1,8,".","")."\t".$str."\n");
		}
		return $this->res;
	}
	// }}}
}

class DBnotAvailable {
	function __call($fName, $fArgs) {
		// {{{
		die('Sorry, your DB-Class is not intilialized!');
		// }}}
	}
}

?>
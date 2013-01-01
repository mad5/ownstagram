<?php

class varArray implements Iterator {
	private $values = array();
	private $types = array();
	private $position;

	public function  __construct(array $values) {
		foreach($values as $key => $value) {
			$this->set($key, $value);
		}
	}
	public function set($name, $value) {
		if(is_array($value)) $this->types[$name] = 'array';
		else $this->types[$name] = 'string';

		$this->values[$name] = $value;

	}

	public function getData() {
	    return $this->values;
	}

        public function is_set($name) {
            if(stristr($name,'/')) {
			$one = str_bis($name,'/');
			$two = str_nach($name,'/');
                        if(!isset($this->values[$one])) return false;
			return $this->isset($two);
            } else {
                return isset($this->values[$name]);
            }
        }
        
	public function get($name, $default=NULL) {
		if(stristr($name,'/')) {
			$one = str_bis($name,'/');
			$two = str_nach($name,'/');
			return $this->get($one)->get($two);
		} else {
			if(isset($this->values[$name])) {
				if($this->types[$name]=='array') return new varArray($this->values[$name]);
				return $this->values[$name];
			}
			else if($default===NULL) {
				return new varArray(array());
			} else return $default;
		}
	}
	
	public function getInt($name, $default=NULL) {
		$res = $this->get($name, $default);
		return (int)$res;
	}


	function __toString() {
		return '';
	}

	public function rewind() {
		$this->position = 0;
	}

	public function count() {
		return count($this->values);
	}

	  public function valid() {
		  if(!is_array($this->values)) $this->values = array();
		return $this->position < count($this->values);
	  }
	private function keyAtPos($position) {
		$K = array_keys($this->values);
		return $K[$position];
	}
	  
	  public function key() {
			return $this->keyAtPos($this->position);
	  }

	  public function current() {
		return $this->get($this->keyAtPos($this->position), '');
	  }

	  public function next() {
		$this->position++;
	  }
}

class template {
	protected $fw;
	protected $VAR = array();
	protected $VARS;
	public $modulName;
        public $development = false;
	function __construct() {
		// {{{
		$this->VARS = new varArray(array());
		
		// }}}
	}
	
	function clearVariable() {
		// {{{
		$this->VAR = array();
		// }}}
	}


	function setVariable($name, $value="") {
		// {{{
		#if(!is_array($this->VAR)) $this->VAR = array();
		if(is_array($name)) {
			#$this->VAR = array_merge($this->VAR, $name);
			foreach($name as $Akey => $Avalue) {
				$this->VARS->set($Akey, $Avalue);
			}
		} else {
			$this->VARS->set($name, $value);
			#$this->VAR[$name] = $value;
		}
		// }}}
	}

	function get($tpl) {
		// {{{	Alias for tplGet
		return($this->tplGet($tpl));
		// }}}
	}

	function tplParse($tplCode) {
		$md5 = 'tmp.'.md5(microtime(true).rand()).'.php';
		$fn = projectPath.'/cache/'.$md5;
		file_put_contents($fn, $tplCode);
		$html = $this->tplGet($fn);
		#unlink($fn);
		return $html;
	}

	function tplGet($tpl) {
		// {{{
		
		if($this->development) {
			try {
				throw new Exception;
			} catch(Exception $e) {
				 $T = $e->getTrace();
				 if(stristr($T[1]['file'],'/modul/') && stristr($T[1]['file'],'/classes/')) {
					 echo "<span style='color:red;font-weight:bold;'>";
					 echo "used templatecall in model-class in:<br>".$T[1]['file']."<br>at line ".$T[1]['line'];
					 exit;
				 }
			}
		}
		
		
		$VAR = $this->VAR;
		$VARS = $this->VARS;
		ob_start();

		if(isset($this->modulName) && $this->modulName!='') {
			$path = '/modul/'.$this->modulName;
		} else $path = '';

		if(substr($tpl,0,1)=='/') include($tpl);
		else {
			if(file_exists(projectPath.$path.'/templates/'.$tpl)) {
				include(projectPath.$path.'/templates/'.$tpl);
			} else if(file_exists(projectPath.'/templates/'.$tpl)) {
				include(projectPath.'/templates/'.$tpl);
			} else if(file_exists(libPath.'/templates/'.$tpl)) {
				include(libPath.'/templates/'.$tpl);
			} else {
				die('Template '.$tpl.' not found');
			}
		}
		
		$html = ob_get_clean();
		return($html);
		// }}}
	}


	function includeTpl($tplName, $data=array(), $modul=NULL) {
		if($modul==NULL) $modul = $this->modulName;
		$tpl = new template();
		$tpl->modulName = $modul;
		foreach($data as $key => $value) {
			$tpl->setVariable($key, $value);
		}
		return $tpl->get($tplName);
	}
}	
?>
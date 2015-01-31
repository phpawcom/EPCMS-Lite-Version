<?php
/********************************************************************************
*                                 EPCMS/ MySQLi Engine                          *
*                                     version: 2                                *
*                             Written By Abdulaziz Al Rashdi                    *
*                   http://www.alrashdi.co  |  https://github.com/phpawcom      *
*********************************************************************************/
class database extends main {
	protected $dbconnect;
	public $dbquery;
	public $dbresult;
	public $dbqueryArr = array();
	private $pages_counter;
	private $configDatabase;
	public function __construct($server, $username, $password, $dbname, $prefix){
		$this->configDatabase = array('server' => $server, 
		                              'username' => $username, 
									  'password' => $password, 
									  'dbname' => $dbname, 
									  'prefix' => $prefix);
		$this->connect();
	}
	public function __destruct(){
		$this->disconnect();
	}
	public function connect()
	{
		$this->dbconnect = @new mysqli($this->configDatabase['server'], 
		                               $this->configDatabase['username'], 
									   $this->configDatabase['password'], 
									   $this->configDatabase['dbname']);
		try {			
			if (mysqli_connect_error())
			  throw new Exception("Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error());
		}
		catch(Exception $e1)
		{
			echo $e1->getMessage()."<br />\n";
			echo '<textarea name="MYSQL_ERROR" cols="100" rows="10">'.$e1->getTraceAsString()."</textarea><br />\n";
			exit;
		}
		$this->dbconnect->set_charset('utf8');
		return $this->dbconnect;
	}
	public function disconnect(){
		if($this->dbconnect == TRUE)
		 @$this->dbconnect->close();
	}
	public function query($sql='', $qryArr=FALSE){
		$this->dbconnect = !isset($this->dbconnect)? $this->connect() : $this->dbconnect;
		try {
			$sql = str_ireplace('#prefix#', $this->configDatabase['prefix'], $sql);
			if(($queryid = @$this->dbconnect->query($sql, MYSQLI_STORE_RESULT)) == FALSE)			
			   throw new Exception('Seems there is an error in Structured Query Language');
			if($qryArr != FALSE){
				$this->dbqueryArr["$qryArr"] = $queryid;
			}else{
				 $this->dbquery = $queryid;
			}
		}
		catch(Exception $e3){
			echo $e3->getMessage()."<br />\n";
			echo '<pre>'.$e3->getTraceAsString()."</pre>\n";
			echo 'MySQLi Error: '.$this->dbconnect->error."<br /><br />\n";
			exit;
		}
				
	}
	public function fetch_array($qryArr=FALSE){
		$queryid = ($qryArr != FALSE)? $this->dbqueryArr["$qryArr"] : $this->dbquery;
		$this->dbresult = mysqli_fetch_array($queryid, MYSQL_BOTH);
		return $this->dbresult;
	}
	public function num_rows($qryArr=FALSE){
		$queryid = ($qryArr != FALSE)? $this->dbqueryArr["$qryArr"] : $this->dbquery;
		$this->dbresult = $queryid->num_rows;
		return $this->dbresult;
	}
	public function insert_id(){
		return $this->dbconnect->insert_id;
	}
	
	public function fetch_fields($qryArr=FALSE){
		$queryid = $qryArr != FALSE? $this->dbqueryArr["$qryArr"] : $this->dbquery;
		return $queryid->fetch_field();
	}
	public function organize_data($data, $predefined_var){
		if(is_array($data)):
		  foreach($data as $fields):
		    $field = parent::safeinput($fields);
			if(strpos($field, 'JSON:') !== false):
			  $field = str_replace('JSON:', '', $field);
			  $json_field = !empty($predefined_var['JSON:'.$field])? $predefined_var['JSON:'.$field] : $predefined_var[$field];
			  @preg_match_all("/\\\\u(\w{4})/", $json_field, $matches);
			  if(is_array($matches)):
			    $slashes = array();
			    foreach($matches[0] as $match):
				  $slashes[$match] = addslashes($match);
				endforeach;
				$sql .= $field.' = \''.str_replace(array_keys($slashes), $slashes, $json_field).'\', ';
			  else:
			    $sql .= $field.' = \''.$predefined_var[$field].'\', ';
			  endif;
			else:
		      $sql .= $field.' = \''.parent::safeinput($predefined_var[$field]).'\', ';
			endif;
		  endforeach;
		  $sql = substr($sql, 0, -2);
		else:
		  $field = parent::safeinput($data);
		  if(strpos($field, 'JSON:') !== false):
		    $field = str_replace('JSON:', '', $field);
			$sql .= str_replace('JSON:', '', $field).' = \''.$predefined_var[$field].'\', ';
		  else:
			$sql = $field.' = \''.parent::safeinput($predefined_var[$field]).'\'';
		  endif;
		endif;
		return $sql;
	}
	public function insert($table, $data, $predefined_var){
		$sql = self::organize_data($data, $predefined_var);
		$query = 'insert into '.$this->configDatabase['prefix'].$table.' set '.$sql;
		self::query($query, 'insert');
	}
	public function update($table, $data, $predefined_var, $selector){
		$sql = self::organize_data($data, $predefined_var);
		$query = 'update '.$this->configDatabase['prefix'].$table.' set '.$sql.' where '.$selector;
		self::query($query, 'update');
	}
	public function count_records($query, $qryArr=FALSE){
		$queryid = $qryArr != FALSE? $this->dbqueryArr["$qryArr"] : $this->dbquery;
		$query = str_replace('*', 'COUNT(*) as total', $query);
		self::query($query, $qryArr);
		$total = self::fetch_array($qryArr);
		return $total['total'];
	}
	public function query_limit($counting, $page = '', $limit = ''){
		$limit = empty($limit)? $this->setting['recordppage'] : $limit;
		//$limit = 1;
		$maximum = ceil($counting/$limit);
		if($page > $maximum) 
		  $page = $maximum;
		$page = (!empty($page) && is_numeric($page))? ($page-1)*$limit : '0' ;
		return $page.','.$limit;
	}
	public function pagination_number($counting, $limit = ''){
		$limit = empty($limit)? $this->setting['recordppage'] : $limit;
		$maximum = ceil($counting/$limit);
		return $maximum;		
	}
	protected function escape_string($input){
		$this->buildScriptVars();
		return $this->dbconnect->real_escape_string($input);
	}
}
?>
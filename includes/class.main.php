<?php
/********************************************************************************
*                                 EPCMS Lite Version                            *
*                                   version: beta 1                             *
*                             Written By Abdulaziz Al Rashdi                    *
*                   http://www.alrashdi.co  |  https://github.com/phpawcom      *
*********************************************************************************/
class main {
	public $db;
	public $settings;
	public $language;
	public $detect;
	public $userid;
	public function __construct($db){
		$this->db = $db;
		
	}
	public function buildScriptVars(){
		$this->language = $GLOBALS['language'];
		$this->settings = $GLOBALS['configSettings'];
		$this->db = $GLOBALS['db'];
		$this->detect = $GLOBALS['detect'];
	}
	public function safeinput($input, $whitespace = false){
		$input = htmlspecialchars($input);
		$input = stripslashes($input);
		$input = $this->db->escape_string($input);
		if($whitespace):
		  $input = preg_replace("/\s+/", " ", $input);
		endif;
		return $input;
	}	
	public function languageFile($file){
		return file_exists('includes/languages/'.$file.'.php')? true : false;
	}
	public function setLanguage(){
		$language = 'default';
		$lang = $this->safeinput($_GET['lang']);
		if(!empty($lang) || !empty($_COOKIE['lang'])):
		  if(!empty($lang) && $this->languageFile($lang)):
		    setcookie('lang', $lang, time() + $this->settings['cookie_life'] , '/');
		    $language = $lang;
		  elseif(!empty($lang) && !$this->languageFile($lang)):
		    setcookie('lang', '', time() - $this->settings['cookie_life'] , '/');
		    $language = 'default';
		  elseif(empty($lang) && !empty($_COOKIE['lang']) && $this->languageFile($_COOKIE['lang'])):
		    setcookie('lang', $this->safeinput($_COOKIE['lang']), time() + $this->settings['cookie_life'] , '/');
		    $language = $this->safeinput($_COOKIE['lang']);
		  endif;
		endif;
		return $language.'.php';
	}
	public function loadModule($module){
		$response = false;
		$module = $this->safeinput($module).'.php';
		if(file_exists($module)):
		  include($module);
		  $response = true;
		endif;
		return $response;
	}
	public function script_path(){
		$name = $_SERVER["SCRIPT_NAME"];
		$path = 'http://'.$_SERVER["HTTP_HOST"].str_replace('/'.basename($name), '', $name);
		$path = str_replace('/admin', '', $path);
		return $path;
	}
	public function reading_multi_languages($input, $languageid='', $editMode = false){
		$temp = $input;
		if(is_array(@json_decode($input, true))):
		  $input = json_decode($input, true);
		  foreach($input as $output):
		    if($output['languageid'] == $languageid):
			  $input = $output['content'];
			  break;
			endif;
		  endforeach;
		  if(empty($input) && $editMode != true):
		    $input = json_decode($temp, true);
		    foreach($input as $output):
			  if(!empty($output['content'])):
				$input = $output['content'];
				break;
			  endif;
			endforeach;
		  endif;
		endif;
		return $input;
	}
	public function is_duplicated($input, $field, $table, $exclude = ''){
		$input = $this->safeinput($input);
		$field = $this->safeinput($field);
		$result = false;
		if(!empty($exclude) && is_array($exclude)):
		  $exclude[0] = $this->safeinput($exclude[0]);
		  $exclude[1] = $this->safeinput($exclude[1]);
		  $exclude = ' && '.$exclude[1].' != \''.$exclude[0].'\' ';
		else:
		  $exclude = '';
		endif;
		if($this->db->count_records('select * from #prefix#'.$table.' where '.$field.'=\''.$input.'\' '.$exclude.' ') > 0):
		  $result = true;
		endif;
		return $result;
	}
	public function generate_random_string($length = 8) {
		$validCharacters = "ABCDEFGHIJKLMNOPQRSTUXYVWZ1234567890";
		$validCharNumber = strlen($validCharacters);
		$result = "";
		for ($i = 0; $i < $length; $i++) {
		  $index = mt_rand(0, $validCharNumber - 1);
		  $result .= $validCharacters[$index];
		}
		return $result;
	}
	public function array_sort_bycolumn(&$array,$column,$dir = 'asc') {
		foreach($array as $a) $sortcol[$a[$column]][] = $a;
		ksort($sortcol);
		foreach($sortcol as $col) {
			foreach($col as $row) $newarr[] = $row;
		}
		
		if($dir=='desc') $array = array_reverse($newarr);
		else $array = $newarr;
	}
	public function api_fetch($url, $header=false, $sslvar=false){
        $connection = curl_init();
        curl_setopt($connection, CURLOPT_URL, $url);
        if(!$header)
          curl_setopt($connection, CURLOPT_HEADER, 0);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($connection, CURLOPT_CONNECTTIMEOUT, 10);
		if(!$sslvar)
		  curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
        $content = curl_exec($connection);
        curl_close($connection);
        return $content;
	}
}
?>
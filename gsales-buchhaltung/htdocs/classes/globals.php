<?php
/** 
 * Diese Klasse beinhaltet ein Objekt in dem die Globals als Objekt verarbeitet
 * und gefiltert werden.
 * 
 * @author 		Stefan Jacomeit <stefan@jacomeit.com>
 * @version		1.0
 * @license		GPLv2
 * @copyright	2010 gsales-buchhaltung
 */
class globals
{
	/**
	 * Klassenvariable der Globals
	 * @staticvar array
	 * @access private
	 */
	static private $_param = array();
	/**
	 * Prueft, ob der Parameter $param in den Globalen $this->_param existiert 
	 * und gibt einen boolean zurueck
	 * 
	 * @param mixed $param
	 * @access public
	 * @static
	 * @return boolean
	 */
	static public function paramExist($param)
	{
		self::_getGlobals();
		return isset(self::$_param[$param]) ? true : false;
	}
	/**
	 * Prueft, ob der Parameter $param als POST verschickt wurde
	 * 
	 * @param mixed $param
	 * @access public
	 * @static
	 * @return boolean
	 */
	static public function isPost($param)
	{
		return isset($_POST[$param]) ? true : false;
	}
	/**
	 * Holt den Wert von $param aus den Globalen und gibt ihn gefiltert zurueck
	 * 
	 * @param mixed $param
	 * @param array $options	optionales Options-Array: htmlentities=true|false, alphanumeric=high|low|norm, range=0-0,0,-0
	 * @access public
	 * @static
	 * @return mixed
	 */
	static public function getParam($param, $options=null)
	{
		self::_getGlobals();
		if (self::paramExist($param)) {
			$type = gettype(self::$_param[$param]);
			switch($type) {
				case 'integer': 
					$filtered = (int)self::$_param[$param];
					break;
				case 'string':
					$filtered = filter_var(self::$_param[$param], FILTER_SANITIZE_STRING);
					break;
			}
			return $filtered;
		}
		return $param;
	}
	/**
	 * Filtert ein Array
	 * 
	 * @param $global
	 * @access public
	 * @static
	 * @return array
	 */
	static public function filterArray($global)
	{
		$filtered = null;
		switch(strtolower($global)) {
			case 'post':
				foreach($_POST as $key => $val) {
					if (is_array($val)) $filtered[$key] = self::filterArray($val);
					else $filtered[$key] = self::getParam($key);
				}
				break;
		}
		return is_array($filtered) ? $filtered : null;
	}
	/**
	 * Holt die Globals aus den Containern und speichert diese in einer 
	 * Klassenvariable
	 * 
	 * @access private
	 * @return void
	 */
	static private function _getGlobals()
	{
		self::$_param = array_merge($_GET, $_POST, $_SERVER);
		if (isset($_SESSION) && is_array($_SESSION)) self::$_param = array_merge(self::$_param, $_SESSION);
		if (isset($_COOKIE) && is_array($_COOKIE)) self::$_param = array_merge(self::$_param, $_COOKIE);
	}
}
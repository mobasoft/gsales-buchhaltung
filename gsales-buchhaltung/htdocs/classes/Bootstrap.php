<?php
/** 
 * Bootstrap Klasse
 * Initialisiert das System
 * 
 * @author 		Stefan Jacomeit <stefan@jacomeit.com>
 * @version		1.0
 * @copyright	2010 Stefan Jacomeit
 * @license		GPLv2
 */
final class Bootstrap
{
	/**
	 * Instanz
	 * @staticvar object Bootstrap
	 * @access private
	 */
	static private $_instance = null;
	/**
	 * Konstruktor
	 * @param string $config
	 * @access private
	 * @return void
	 */
	private function __construct($config)
	{
		if (!file_exists($config)) {
			trigger_error('Config-File not exists in '.$config, E_USER_ERROR);
			return;
		}
		try {
			$config = new Zend_Config_Ini($config);
			Zend_Registry::set('config', $config->toArray());
			// Default-Settings
			date_default_timezone_set('Europe/Berlin');
			setlocale(LC_ALL,'de_DE.utf8');
		} catch (Zend_Exception $e) {
			trigger_error($e->getDebugTrace(), E_USER_ERROR);
		}
	}
	/**
	 * Erzeugt die Instanz des Bootstrap's
	 * @param array $config		Konfigurationsdatei
	 * @access public
	 * @static
	 * @return object Bootstrap
	 */
	static public function getInstance($config=null)
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new Bootstrap($config);
		}
		return self::$_instance;
	}
	/**
	 * Smarty-Instanz erzeugen und zurueckgeben
	 * @access public
	 * @return object Smarty
	 */
	static public function getSmarty()
	{
		$config = Zend_Registry::get('config');
		include_once(SMARTY_DIR.'Smarty.class.php');
		$smarty = new Smarty;
		$smarty->setTemplateDir($config['smarty']['dirs']['tpls']);
		$smarty->setCompileDir($config['smarty']['dirs']['compile']);
		if ($config['smarty']['debugging']==1) {
			$smarty->force_compile = true;
			$smarty->setCaching(false);
			$smarty->setDebugging(true);
		} else {
			$smarty->setCacheDir($config['smarty']['dirs']['cache']);
			$smarty->setCaching(true);
		}
		// @todo: Username dynamisch einfuegen
		$smarty->assign('username', 'admin');
		return $smarty;
	}
	/**
	 * Clonen verhindern
	 * @access public
	 * @return void
	 */
	public function __clone()
	{
		trigger_error('Cloning this class is not allowed!', E_USER_ERROR);
		return;
	}
}

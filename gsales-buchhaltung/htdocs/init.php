<?php
/**
 * Initialisierungsfile
 * Innerhalb dieser Datei wird das System initialisiert, alle benoetigten 
 * Konstanten und Objekte erzeugt und sollte von jedem Controller als Erstes 
 * eingebunden werden.
 * 
 * @author		Stefan Jacomeit <stefan@jacomeit.com>
 * @version		1.0
 * @copyright	2010 Stefan Jacomeit
 * @license		GPLv2
 */
if (!defined('GBSYSPATH')) define('GBSYSPATH', dirname(__FILE__));
if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
if (!defined('GBCLASSES')) define('GBCLASSES', GBSYSPATH.DS.'classes');
if (!defined('GBLIBS')) define('GBLIBS', GBSYSPATH.DS.'libs');
if (!defined('GBZF')) define('GBZF', GBLIBS.DS.'zf');
if (!defined('GBPEAR')) define('GBPEAR', GBLIBS.DS.'pear');
if (!defined('SMARTY_DIR')) define('SMARTY_DIR', GBLIBS.DS.'smarty'.DS);
// Include-Path neu setzen
set_include_path(GBLIBS.PATH_SEPARATOR.GBZF.PATH_SEPARATOR.GBPEAR.PATH_SEPARATOR.GBLIBS.DS.'ofc');
// Debugging
//include_once(GBLIBS.DS.'debuglib.php');
// Bootstrap initialisieren
include_once(GBCLASSES.DS.'Bootstrap.php');
Bootstrap::getInstance(GBSYSPATH.DS.'config'.DS.'config.ini');
// Globale Filterklasse inkludieren
include_once(GBCLASSES.DS.'globals.php');
/**
 * Autoloading ueberschreiben
 * @param string $class
 * @access public
 * @return void
 */
function __autoload($class)
{
	$framework = ($pos = strpos($class, '_')) ? substr($class, 0, $pos) : '';
	switch($framework) {
		case 'Zend': 
			$filename = str_replace('_',DS,$class).'.php';
			if (!file_exists(GBLIBS.DS.$filename)) {
				trigger_error('Class not found in '.GBLIBS.DS.$filename, E_USER_ERROR);
				return;
			}
			include_once(GBLIBS.DS.$filename);
			return;
		case 'GB':
			$filename = substr($class, $pos+1, strlen($class)).'.php';
			if (!file_exists(GBCLASSES.DS.$filename)) {
				trigger_error('Class not found in '.GBCLASSES.DS.$filename.': '.var_export(debug_backtrace()), E_USER_ERROR);
				return;
			}
			include_once(GBCLASSES.DS.$filename);
			return;
	}
}

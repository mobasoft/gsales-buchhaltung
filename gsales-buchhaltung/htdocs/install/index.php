<?php
/**
 * Installskript
 * Dieses Skript installiert das System und stellt dies ein.
 * 
 * @license GPLv2
 * @copyright 2010 gsales-buchhaltung|http://code.google.com/p/gsales-buchhaltung/
 */
include('../init.php');

if (globals::isPost('check')) {
	switch(globals::getParam('check')) {
		case 'dirs':
			$data = globals::getParam('datadir');
			$cache = globals::getParam('cache');
			$compile = globals::getParam('compile');
			if (!is_dir($data)) { echo '#dirs-data:Data-Verzeichnis existiert nicht';exit; }
			elseif (!is_writeable($data)) {echo '#dirs-data:Data-Verzeichnis ist nicht beschreibbar';exit;}
			elseif (!is_dir($cache)) {echo '#dirs-cache:Cache-Verzeichnis existiert nicht';exit;}
			elseif (!is_writeable($cache)) {echo '#dirs-cache:Cache-Verzeichnis ist nicht beschreibbar';exit;}
			elseif (!is_dir($compile)) {echo '#dirs-compile:Compile-Verzeichnis existiert nicht';exit;}
			elseif (!is_writeable($compile)) {echo '#dirs-compile:Compile-Verzeichnis ist nicht beschreibbar';exit;}
			else echo 'OK';
			break;
		case 'db':
			
			echo 'OK';
			break;
	}
	exit;
}

get_header();
$config = Zend_Registry::isRegistered('config') ? Zend_Registry::get('config') : array();
?>
<h1>Installation der gsales-Buchhaltung</h1>
<form action="" method="post" id="install">
<div id="msg" class="ui-state-error" style="display:none;"></div>
<div class="ui-widget ui-corner-all">
<div class="ui-widget-header ui-corner-all">Pfad-Angaben</div>
<div class="ui-widget-content">
<fieldset>
<legend>System-Verzeichnisse</legend>
<div><label for="dirs-data">DATA:</label> <input type="text" name="dirs-data" id="dirs-data" value="<?php echo $config['datadir'] ?>" class="fields" style="width:40%;" /></div>
<div><label for="dirs-cache">Smarty-Cache:</label> <input type="text" name="dirs-cache" id="dirs-cache" value="<?php echo $config['smarty']['dirs']['cache']; ?>" class="fields" style="width:40%;" /></div>
<div><label for="dirs-compile">Smarty-Compile:</label> <input type="text" name="dirs-compile" id="dirs-compile" value="<?php echo $config['smarty']['dirs']['compile']; ?>" class="fields" style="width:40%;" /></div>
</fieldset>
<br />
<fieldset>
<legend>Datenbank-Daten</legend>
<div><label for="db-adapter">Adapter:</label> <select name="db-adapter" id="db-adapter" size="1">
<option value="pdo_mysql">PDO-MySQL</option><option value="mysql" selected="selected">MySQL</option>
</select></div>
<div><label for="db-hostspec">Host:</label> <input type="text" name="db-hostspec" id="db-hostspec" value="<?php echo $config['dsn']['hostspec']; ?>" class="fields" /></div>
<div><label for="db-name">DB-Name:</label> <input type="text" name="db-name" id="db-name" value="<?php echo $config['dsn']['database']; ?>" class="fields" /></div>
<div><label for="db-username">Benutzername:</label> <input type="text" name="db-username" id="db-username" value="<?php echo $config['dsn']['database']; ?>" class="fields" /></div>
<div><label for="db-password">Passwort:</label> <input type="password" name="db-password" id="db-password" value="<?php echo $config['dsn']['password']; ?>" class="fields" /></div>
</fieldset>
<br />
<fieldset>
<legend>gSales API</legend>
<div><label for="api-key">API-Schlüssel:</label> <input type="text" name="api-key" id="api-key" value="<?php echo $config['api']['key']; ?>" class="fields" /></div>
</fieldset>
<p class="submit"><input type="submit" id="check" value="Prüfen & Installieren" /></p>
</div>
</div>
</form>
<?php
get_footer();
exit;

/**
 * Gibt den Header zurueck
 */
function get_header()
{
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>gsales-Buchhaltung Installation</title>
	<script type="text/javascript" src="/libs/jquery/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="/install/scripts.js"></script>
	<link rel="stylesheet" type="text/css" href="/libs/jquery/custom-theme/jquery-ui-1.8.7.custom.css" />
	<link rel="stylesheet" type="text/css" href="/media/styles.css" />
	</head>
	<body>
	<div id="header">
		<div id="logo"><img src="/media/img/logo_gsales.png" class="logo" /><span>buchhaltung</span></div>
	</div>
	<div id="wrap">
	<div id="content">
	<?php
}
/**
 * Gibt den Footer zurueck
 */
function get_footer()
{
	?>
	</div>
	<div id="footer">&copy; 2010 <a href="http://code.google.com/p/gsales-buchhaltung/" target="_blank">gSales-Buchhaltung</a></div>
	</div>
	</body>
	</html>
	<?php
}
/**
 * Funktion zum pruefen der beschreibbaren Verzeichnisse
 */
function checkPathes()
{
	$dir = defined('DATA') ? DATA : dirname(__FILE__).DS.'..'.DS.'data';
	$libs = defined('LIBS') ? LIBS : dirname(__FILE__).DS.'..'.DS.'libs';
	$smarty = $libs.DS.'smarty'.DS;
	if (!is_dir($dir) || !is_writeable($dir)) return '/data Verzeichnis existiert nicht oder ist nicht für das Skript beschreibbar. Bitte das Verzeichnis anlegen und die Rechte auf chmod 777 setzen!';
	if (!is_dir($smarty.'cache') || !is_writeable($smarty.'cache')) return 'Smarty-Cache-Verzeichnis in /libs/smarty/cache existiert nicht oder ist nicht beschreibbar. Bitte das Verzeichnis anlegen und die Rechte auf chmod 777 setzen!';
	if (!is_dir($smarty.'compile') || !is_writeable($smarty.'compile')) return 'Smarty-Compile-Verzeichnis in /libs/smarty/compile existiert nicht oder ist nicht beschreibbar. Bitte das Verzeichnis anlegen und die Rechte auf chmod 777 setzen!';
	return true;
}
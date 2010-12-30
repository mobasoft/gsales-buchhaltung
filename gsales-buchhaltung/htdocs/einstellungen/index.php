<?php
/**
 * Einstellungs-Site
 */
include_once('../init.php');
$smarty = Bootstrap::getSmarty();
$set = globals::paramExist('set') ? globals::getParam('set') : 'none';
switch($set) {
	case 'system':
		if (globals::isPost('save')) {
			print_a(globals::filterArray('post'));
		}
		$tpl = 'einstellungen/system.html';
		$smarty->assign('config', Zend_Registry::get('config'));
		break;
	case 'konten':
		if (globals::paramExist('add')) {
			$tpl = 'einstellungen/add_konto.html';
		} else {
			$tpl = 'einstellungen/konten.html';
		}
		break;
	default: 
		$tpl = 'einstellungen/index.html';
}
$smarty->display($tpl);
<?php
/**
 * Statistik-File
 */
include_once('../init.php');
$smarty = Bootstrap::getSmarty();
$set = globals::paramExist('set') ? globals::getParam('set') : null;
switch($set) {
	case 'monat':
		$tpl = 'stats/monat.html';
		break;
	case 'quartal':
		$tpl = 'stats/quartal.html';
		break;
	case 'jahr':
		$tpl = 'stats/jahr.html';
		break;
	case 'ea':
		$tpl = 'stats/ea.html';
		break;
	default:
		$tpl = 'stats/index.html';
}
$smarty->display($tpl);

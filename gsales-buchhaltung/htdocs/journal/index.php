<?php
/**
 * Journal-Index
 */
include_once('../init.php');
$smarty = Bootstrap::getSmarty();
$set = globals::paramExist('set') ? globals::getParam('set') : null;
switch($set) {
	case 'new':
		if (globals::paramExist('w') && globals::getParam('w')=='ausgabe') {
			$tpl = 'journal/ausgabe.html';
		} else {
			$tpl = 'journal/einnahme.html';
		}
		break;
	case 'import':
		$tpl = 'journal/import.html';
		break;
	default: $tpl = 'journal/index.html';
}
$smarty->display($tpl);

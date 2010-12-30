<?php
include_once('init.php');
if (globals::paramExist('tbl')) {
	switch(globals::getParam('tbl')) {
		case 'konten': // Bilanzkonten holen und als JSON zurueckgebens
			break;
		case 'notImportInvoices': // Noch nicht importierte Rechnungen via API holen und als JSON zurueckgeben
			break;
	}
}
exit;
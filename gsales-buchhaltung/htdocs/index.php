<?php
/**
 * Base-File
 */
include_once('init.php');
$smarty = Bootstrap::getSmarty();

$smarty->display("index.html");

<?php 
	require('./config.php');
	require($CFG->dirroot.'/lib/Template.php');
	$tpl = new Template();
	$tpl->show('member');
?>
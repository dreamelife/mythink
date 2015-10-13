<?php 
unset($CFG);
global $CFG;
$CFG = new stdClass();
$CFG->wwwroot = 'http://127.0.0.1/mythink';
$CFG->dirroot = 'D:\\www\\mythink';






function dump($data,$exit=0){
	echo "<pre>";
	$debug = debug_backtrace()['0'];
	echo 'dir:'.$debug['file'].' line:'.$debug['line'];
	echo "<br>-------------------------<br>";
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	if($exit != '0'){
		exit;
	}
}
?>
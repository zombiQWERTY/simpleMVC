<?
$host      = 'localhost';
$user      = 'root';
$password  = 'zvezda';
$database  = 'simpleMVC';
$charset   = 'utf8';

$connections = array(
	'development' => 'mysql://'.$user.':'.$password.'@'.$host.'/'.$database.'?charset='.$charset,
	'production'  => 'mysql://'.$user.':'.$password.'@'.$host.'/'.$database.'?charset='.$charset
);
?>
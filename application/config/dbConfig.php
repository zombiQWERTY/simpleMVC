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

ActiveRecord\Config::initialize(function($cfg) use ($connections) {
	$cfg->set_model_directory($this->root.APPPATH.'/models/');
	$cfg->set_connections($connections);
	$cfg->set_default_connection('development');
});
?>
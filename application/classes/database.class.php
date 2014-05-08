<?
class Database {
	
	function __construct() {
		$connections = array(
			'development' => 'mysql://'.Config::$user.':'.Config::$password.'@'.Config::$host.'/'.Config::$database.'?charset='.Config::$charset,
			'production'  => 'mysql://'.Config::$user.':'.Config::$password.'@'.Config::$host.'/'.Config::$database.'?charset='.Config::$charset
		);

		ActiveRecord\Config::initialize(function($cfg) use ($connections) {
			$cfg->set_model_directory(APPPATH.'mvc/models/');
			$cfg->set_connections($connections);
			$cfg->set_default_connection('development');
		});
	}

}
?>
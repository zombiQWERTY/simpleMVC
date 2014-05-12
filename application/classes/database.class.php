<?
/**
 * SimpleMVC
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		SimpleMVC
 * @author		zombiQWERTY
 * @copyright	Copyright (c) 2014, zombiQWERTY
 * @link		http://zombiqwerty.ru/simplemvc/
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

/**
 * Config db file with default settings
 *
 * @package		SimpleMVC
 * @category	Back-controller
 * @author		zombiQWERTY
 * @link		http://zombiqwerty.ru/simplemvc/
 */

class Database {
	
	/**
	 * Constructor
	 * Конструктор
	 */
	function __construct() {

		/**
		 * Variants of connections
		 * Варианты соединений
		 */
		$connections = array(
			'development' => 'mysql://'.Config::$user.':'.Config::$password.'@'.Config::$host.'/'.Config::$database.'?charset='.Config::$charset,
			'production'  => 'mysql://'.Config::$user.':'.Config::$password.'@'.Config::$host.'/'.Config::$database.'?charset='.Config::$charset
		);

		ActiveRecord\Config::initialize(function($cfg) use ($connections) {
			$cfg->set_model_directory(APPPATH.'mvc/models/');
			$cfg->set_connections($connections);

			/**
			 * Name of default connection
			 * Имя соединения по-умолчанию
			 */
			$cfg->set_default_connection('development');
		});
	}

}
?>
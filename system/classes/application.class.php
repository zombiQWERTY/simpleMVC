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
 * System Initialization File
 *
 * Loads the base classes and executes the request.
 *
 * @package		SimpleMVC
 * @category	Front-controller
 * @author		zombiQWERTY
 * @link		http://zombiqwerty.ru/simplemvc/
 */

/**
 * SimpleMVC Version
 *
 * @var string
 */
define('SM_VERSION', '2.0.1');

class Application {

	/**
	 * Constructor
	 */
	public function __construct() {
		if (Config::$db) {
			require_once SYSPATH.'ActiveRecord/ActiveRecord.php';
			new Database();
		}
		new SM();
	}

}
?>
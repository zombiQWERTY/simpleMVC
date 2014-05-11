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
 * Autoload classes
 *
 * @package		SimpleMVC
 * @category	Back-controller
 * @author		zombiQWERTY
 * @link		http://zombiqwerty.ru/simplemvc/
 */

// ------------------------------------------------------------------------

/**
 * Get classes on the go
 *
 * @param	string
 * @return	class
 */
spl_autoload_register(function($class) {
	$paths = array(APPPATH.'classes/', SYSPATH.'classes/', APPPATH.'libraries/');

	foreach ($paths as $path) {
		$postfix = ($path != APPPATH.'libraries/') ? ('.class') : ('');
		$filename = $path.strtolower(str_replace('\\', '/', $class)).$postfix.'.php';
		if (file_exists($filename)) {
		    require_once $filename;
		    break;
		}
	}
});
?>
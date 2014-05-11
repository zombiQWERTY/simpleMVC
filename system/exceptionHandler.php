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
 * Exception handler for native php errors
 *
 * @package		SimpleMVC
 * @category	Back-controller
 * @author		zombiQWERTY
 * @link		http://zombiqwerty.ru/simplemvc/
 */

// ------------------------------------------------------------------------

/**
 * Exception handler
 *
 * @param	string
 * @param	string
 * @param	string
 * @param	string
 * @return	class
 */
function exceptionHandler($severity, $message, $filepath, $line) {
	if ($severity == E_STRICT)
		return;

	if (($severity & error_reporting()) == $severity)
		Exceptions::showPhpError($severity, $message, $filepath, $line);
}
?>
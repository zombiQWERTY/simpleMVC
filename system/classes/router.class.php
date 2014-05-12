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
 * Router functions
 *
 * @package		SimpleMVC
 * @category	Front-controller
 * @author		zombiQWERTY
 * @link		http://zombiqwerty.ru/simplemvc/
 */

class Router {

	/**
	 * Get all uri segments
	 *
	 * @access	public
	 * @return	array
	 */
	public static function getUriSegments() {
		$segments = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		if ($segments) {
			array_shift($segments);
			return $segments;
		} else {
			return false;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Get uri segment by num
	 *
	 * @access	public
	 * @param	int		segment number
	 * @return	string
	 */
	public static function getUriSegment($num = 0) {
		$segments = Router::getUriSegments();
		if (count($segments)) {
			return $segments[$num];
		} else {
			return null;
		}
	}
	
}
?>
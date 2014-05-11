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
 * Common Functions
 *
 * @package		SimpleMVC
 * @category	Back-controller
 * @author		zombiQWERTY
 * @link		http://zombiqwerty.ru/simplemvc/
 */

class Common {

	/**
	* Determines if the current version of PHP is greater then the supplied value
	*
	* Since there are a few places where we conditionally test for PHP > 5
	* we'll set a static variable.
	*
	* @access	public
	* @param	string
	* @return	bool	TRUE if the current version is $version or higher
	*/
	public function isPhp($version = '5.0.0') {
		static $php;
		$version = (string)$version;
		
		if (!isset($php[$version])) {
			$php[$version] = (version_compare(PHP_VERSION, $version) < 0) ? (false) : (true);
		}

		return $php[$version];
	}

	// ------------------------------------------------------------------------

	/**
	 * Set HTTP Status Header
	 *
	 * @access	public
	 * @param	int		the status code
	 * @param	string
	 * @return	void
	 */
	public function setStatusHeader($code = 200, $text = '') {
		$stati = array(
			200	=> 'OK',
			201	=> 'Created',
			202	=> 'Accepted',
			203	=> 'Non-Authoritative Information',
			204	=> 'No Content',
			205	=> 'Reset Content',
			206	=> 'Partial Content',

			300	=> 'Multiple Choices',
			301	=> 'Moved Permanently',
			302	=> 'Found',
			304	=> 'Not Modified',
			305	=> 'Use Proxy',
			307	=> 'Temporary Redirect',

			400	=> 'Bad Request',
			401	=> 'Unauthorized',
			403	=> 'Forbidden',
			404	=> 'Not Found',
			405	=> 'Method Not Allowed',
			406	=> 'Not Acceptable',
			407	=> 'Proxy Authentication Required',
			408	=> 'Request Timeout',
			409	=> 'Conflict',
			410	=> 'Gone',
			411	=> 'Length Required',
			412	=> 'Precondition Failed',
			413	=> 'Request Entity Too Large',
			414	=> 'Request-URI Too Long',
			415	=> 'Unsupported Media Type',
			416	=> 'Requested Range Not Satisfiable',
			417	=> 'Expectation Failed',

			500	=> 'Internal Server Error',
			501	=> 'Not Implemented',
			502	=> 'Bad Gateway',
			503	=> 'Service Unavailable',
			504	=> 'Gateway Timeout',
			505	=> 'HTTP Version Not Supported'
		);

		if ($code == '' || !is_numeric($code)) {
			showError('Status codes must be numeric', 500);
		}

		if (isset($stati[$code]) && $text == '') {
			$text = $stati[$code];
		}

		if ($text == '') {
			showError('No status text available. Please check your status code number or supply your own message text.', 500);
		}

		$serverProtocol = (isset($_SERVER['SERVER_PROTOCOL'])) ? ($_SERVER['SERVER_PROTOCOL']) : (false);

		if (substr(php_sapi_name(), 0, 3) == 'cgi') {
			header("Status: {$code} {$text}", true);
		} elseif ($serverProtocol == 'HTTP/1.1' || $serverProtocol == 'HTTP/1.0') {
			header($serverProtocol." {$code} {$text}", true, $code);
		} else {
			header("HTTP/1.1 {$code} {$text}", true, $code);
		}
	}

}
?>
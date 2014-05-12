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
 * Exceptions Class
 *
 * @package		SimpleMVC
 * @category	Exceptions
 * @author		zombiQWERTY
 * @link		http://zombiqwerty.ru/simplemvc/
 */

class Exceptions {

	public $severity;
	public $message;
	public $filename;
	public $line;

	/**
	 * Nesting level of the output buffering mechanism
	 *
	 * @var int
	 * @access public
	 */
	public static $obLevel;

	/**
	 * List if available error levels
	 *
	 * @var array
	 * @access public
	 */
	public static $levels = array(
		E_ERROR				=>	'Error',
		E_WARNING			=>	'Warning',
		E_PARSE				=>	'Parsing Error',
		E_NOTICE			=>	'Notice',
		E_CORE_ERROR		=>	'Core Error',
		E_CORE_WARNING		=>	'Core Warning',
		E_COMPILE_ERROR		=>	'Compile Error',
		E_COMPILE_WARNING	=>	'Compile Warning',
		E_USER_ERROR		=>	'User Error',
		E_USER_WARNING		=>	'User Warning',
		E_USER_NOTICE		=>	'User Notice',
		E_STRICT			=>	'Runtime Notice'
	);


	/**
	 * Constructor
	 */
	public function __construct() {
		Exceptions::$obLevel = ob_get_level();
	}

	// --------------------------------------------------------------------

	/**
	 * 404 Page Not Found Handler
	 *
	 * @access	public
	 * @return	string
	 */
	public function show404() {
		$heading = '404 Страница не найдена';
		$message = 'Запрошенная страница не найдена.';
		Exceptions::showError($heading, $message, 'error404', 404);
		exit;
	}

	// --------------------------------------------------------------------

	/**
	 * General Error Page
	 *
	 * This function takes an error message as input
	 * (either as a string or an array) and displays
	 * it using the specified template.
	 *
	 * @access	public
	 * @param	string	the heading
	 * @param	string	the message
	 * @param	string	the template name
	 * @param 	int		the status code
	 * @return	string
	 */
	public function showError($heading, $message, $template = 'errorGeneral', $statusCode = 500) {
		Common::setStatusHeader($statusCode);

		$message = '<p>'.implode('</p><p>', (!is_array($message)) ? (array($message)) : ($message)).'</p>';

		if (ob_get_level() > Exceptions::$obLevel + 1) {
			ob_end_flush();
		}
		ob_start();
		require_once APPPATH.'mvc/views/errors/'.$template.'.php';
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;
	}

	// --------------------------------------------------------------------

	/**
	 * Native PHP error handler
	 *
	 * @access	public
	 * @param	string	the error severity
	 * @param	string	the error string
	 * @param	string	the error filepath
	 * @param	string	the error line number
	 * @return	string
	 */
	public static function showPhpError($severity, $message, $filepath, $line) {
		$severity = (!isset(Exceptions::$levels[$severity])) ? ($severity) : (Exceptions::$levels[$severity]);

		$filepath = str_replace("\\", "/", $filepath);

		if (FALSE !== strpos($filepath, '/')) {
			$x = explode('/', $filepath);
			$filepath = $x[count($x)-2].'/'.end($x);
		}

		if (ob_get_level() > Exceptions::$obLevel + 1) {
			ob_end_flush();
		}
		ob_start();
		require_once APPPATH.'mvc/views/errors/errorPhp.php';
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;
	}

}
?>
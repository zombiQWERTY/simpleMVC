<?
class Exceptions {

	public $severity;
	public $message;
	public $filename;
	public $line;

	public static $obLevel;

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


	public function __construct() {
		Exceptions::$obLevel = ob_get_level();
	}

	public function show404() {
		$heading = '404 Страница не найдена';
		$message = 'Запрошенная страница не найдена.';
		Exceptions::showError($heading, $message, 'error404', 404);
		exit;
	}

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
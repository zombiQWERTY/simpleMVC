<?
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
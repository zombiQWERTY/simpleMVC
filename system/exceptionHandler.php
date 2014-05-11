<?
function exceptionHandler($severity, $message, $filepath, $line) {
	if ($severity == E_STRICT)
		return;

	if (($severity & error_reporting()) == $severity)
		Exceptions::showPhpError($severity, $message, $filepath, $line);
}
?>
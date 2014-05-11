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
 * Error handler
 *
 * @package		SimpleMVC
 * @category	Exceptions
 * @author		zombiQWERTY
 * @link		http://zombiqwerty.ru/simplemvc/
 */

class Error {

	/**
	* Error Handler
	*
	* This function lets us invoke the exception class and
	* display errors using the standard error template located
	* in application/mvc/views/errors/errorGeneral.php
	* This function will send the error page directly to the
	* browser and exit.
	*
	* @access	public
	* @return	void
	*/
	public function showError($message, $statusCode = 500, $heading = 'Произошла ошибка') {
		echo Exceptions::showError($heading, $message, 'errorGeneral', $statusCode);
		exit;
	}

	// ------------------------------------------------------------------------

	/**
	* 404 Page Handler
	*
	* This function is similar to the showError() function above
	* However, instead of the standard error template it displays
	* 404 errors.
	*
	* @access	public
	* @return	void
	*/
	public function show404() {
		Exceptions::show404();
		exit;
	}
	
}
?>
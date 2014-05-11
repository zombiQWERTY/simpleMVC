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
 * Framework Initialization File
 *
 * @package		SimpleMVC
 * @category	Back-controller
 * @author		zombiQWERTY
 * @link		http://zombiqwerty.ru/simplemvc/
 */

// ------------------------------------------------------------------------

/**
 * Set header charset and Moscow locale
 */
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'Russian_Russia.65001');

// ------------------------------------------------------------------------

/**
 * Define useful consts for work
 */
define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST']);
define('ROOT'    , $_SERVER['DOCUMENT_ROOT']);
define('APPPATH' , ROOT.'/application/');
define('SYSPATH' , ROOT.'/system/');

// ------------------------------------------------------------------------

/**
 * require needful files
 */
require_once SYSPATH.'autoload.php';
require_once SYSPATH.'exceptionHandler.php';

// ------------------------------------------------------------------------

/**
 * Set handler for native php errors
 */
set_error_handler('exceptionHandler');

// ------------------------------------------------------------------------

/**
 * Disable magic quotes
 */
if (!Common::isPhp('5.3')) @set_magic_quotes_runtime(0);

// ------------------------------------------------------------------------

/**
 * Initialization the application
 */
new Application();
?>
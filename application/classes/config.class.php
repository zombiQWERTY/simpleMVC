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
 * Config file with default settings
 *
 * @package		SimpleMVC
 * @category	Back-controller
 * @author		zombiQWERTY
 * @link		http://zombiqwerty.ru/simplemvc/
 */

class Config {

	/**
	 * Set the index controller of your app. Can not be 'index'
	 * Устанавливает главный контроллер Вашего приложения. Не может быть 'index'
	 */
	public static $indexPage = 'main';

	/**
	 * Set the layout of your app
	 * Устанавливает шаблон Вашего приложения
	 */
	public static $layout    = 'default';


	/**
	 * Switch on/off work with db
	 * Включает/выключает работу с базой данных
	 */
	public static $db        = true;

	/**
	 * Set the db connect host
	 * Устанавливает хост для соединения с базой данных
	 */
	public static $host      = 'localhost';

	/**
	 * Set the db connect username
	 * Устанавливает логин для соединения с базой данных
	 */
	public static $user      = 'root';

	/**
	 * Set the db connect password
	 * Устанавливает пароль для соединения с базой данных
	 */
	public static $password  = 'zvezda';

	/**
	 * Set the database for work with db
	 * Устанавливает таблицу для работы с базой данных
	 */
	public static $database  = 'simpleMVC';

	/**
	 * Set the db connect charset
	 * Устанавливает кодировку для соединения с базой данных
	 */
	public static $charset   = 'utf8';
	
}
?>
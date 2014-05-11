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
 * MVC Initialization File
 *
 * @package		SimpleMVC
 * @category	Front-controller
 * @author		zombiQWERTY
 * @link		http://zombiqwerty.ru/simplemvc/
 */

class SM {

	/**
	 * Array for user data
	 *
	 * @var array
	 * @access public
	 */
	public static $data;

	/**
	 * Array for actions with helpers
	 *
	 * @var array
	 * @access public
	 */
	public static $helper;


	/**
	 * Constructor
	 */
	function __construct() {
		require_once APPPATH.'mvc/controllers/application.ctrl.php';
		$this->setController();
		$this->loadView(Config::$indexPage);
	}

	// ------------------------------------------------------------------------

	/**
	 * Set Controller
	 *
	 * @access	public
	 * @return	controller
	 */
	public function setController() {
		$segment    = (!Router::getUriSegment(1)) ? (Config::$indexPage) : (Router::getUriSegment(1));
		$controller = APPPATH.'mvc/controllers/'.$segment.'.ctrl.php';
		if (file_exists($controller))
			require_once $controller;
		else
			Error::show404();
	}

	// ------------------------------------------------------------------------

	/**
	 * Load view
	 *
	 * @access	public
	 * @param	string
	 * @return	layout and view
	 */
	public function loadView($name = '') {
		$name = (!$name) ? (Config::$indexPage) : ($name);
		$layout = APPPATH.'mvc/views/layout/'.Config::$layout.'.layout.php';
		$view   = APPPATH.'mvc/views/pages/'.$name.'.view.php';

		if (!file_exists($layout)) Error::showError('Ошибка загрузки шаблона '.Config::$layout);
		if (!file_exists($view))   Error::showError('Ошибка загрузки вида '.$name);

		ob_start();
		if (SM::$data) {
			foreach (SM::$data as $key => $value) {
				${$key} = $value;
			}
		}
		require_once $view;
		SM::$data['content'] = ob_get_contents();
		ob_end_clean();

		if (SM::$data) {
			foreach (SM::$data as $key => $value) {
				${$key} = $value;
			}
		}
		require_once $layout;
	}

	// ------------------------------------------------------------------------

	/**
	 * Load helper
	 *
	 * @access	public
	 * @param	string
	 * @return	helper
	 */
	public function loadHelper($name = '') {
		if ($name) {
			if (is_array($name)) {
				foreach ($name as $key => $helper) {
					$file = APPPATH.'/helpers/'.$helper.'.helper.php';
					if (file_exists($file)) {
						require_once $file;
					} else {
						Error::showError('Ошибка загрузки хелпера '.$helper);
					}
				}
			} else {
				$file = APPPATH.'/helpers/'.$name.'.helper.php';
				if (file_exists($file)) {
					require_once $file;
				} else {
					Error::showError('Ошибка загрузки хелпера '.$name);
				}
			}
		} else {
			Error::showError('Не указано название хелпера');
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Load user library class
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	class
	 */
	public function loadLibrary($class, $params = '') {
		$class = new $class($params);
		return $class;
	}

	// ------------------------------------------------------------------------

	/**
	 * Get user partitions in views
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	public function inc($include) {
		if ($include) {
			$file = APPPATH.'/mvc/views/pages/includes/'.$include.'.inc.php';
			if (file_exists($file)) {
				require_once $file;
			} else {
				Error::showError('Ошибка загрузки части шаблона '.$include);
			}
		} else {
			Error::showError('Не указано название части шаблона');
		}
	}

}
?>
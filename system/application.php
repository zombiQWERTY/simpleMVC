<?
/**
 * SimpleMVC
 *
 * Open Source MVC приложение для разработки веб сайтов
 *
 * @package		SimpleMVC
 * @author		zombiQWERTY
 * @copyright	Copyright (c) 2014, zombiQWERTY
 * @link		http://zombiqwerty.ru/portfolio/simpleMVC/
 * @since		Version 1.0.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Сборщик основных методов
 *
 * Содержит основные методы и управляет роутами
 *
 * @package		SimpleMVC
 * @subpackage	SimpleMVC
 * @category	Front-controller
 * @author		zombiQWERTY
 * @link		http://zombiqwerty.ru/portfolio/simpleMVC/
 */


/**
 * SimpleMVC версия
 *
 * @var string
 *
 */
define('SM_VERSION', '1.0.0');

class Application extends Config{
	
	private $controller;
	private $root;
	private $data;
	private $autoload;


	/**
	 * Конструктор. Получаем имя файла контроллера, абсолютный путь до корня сайта
	 * Подключаем работу с базой данных, включаем автозагрузку, устанавливаем контроллер, загружаем вид по-умолчанию (из конфига)
	 *
	 */
	public function __construct() {
		$this->controller = $this->separate($_SERVER['REQUEST_URI']);
		$this->root       = $_SERVER['DOCUMENT_ROOT'];
		self::autoload();
		self::database();
		self::setController();
		self::loadView($this->indexPage);
	}


	/**
	 * Загружаем модель.
	 *
	 * @example $this->loadModel('model');
	 * @example $this->loadModel(array('model1', 'model2'));
	 *
	 * @var $name: string или array - имя файла модели
	 *
	 */
	private function loadModel($name) {
		if (is_array($name)) {
			foreach ($name as $key => $value) {
				$file = $this->root.APPPATH.'mvc/models/'.$value.'.php';
				if (file_exists($file)) {
					require_once $file;
				} else {
					self::error('general', 'Ошибка загрузки модели '.$name);
					die();
				}
			}
		} else {
			$file = $this->root.APPPATH.'mvc/models/'.$name.'.php';
			if (file_exists($file)) {
				require_once $file;
			} else {
				self::error('general', 'Ошибка загрузки модели '.$name);
				die();
			}
		}
	}


	/**
	 * Устанавливаем контроллер.
	 *
	 */
	private function setController() {
		require_once $this->root.APPPATH.'mvc/controllers/application.php'; // Подключаем общий контроллер, в котором содержится код для всех страниц сайта
		$file = $this->root.APPPATH.'mvc/controllers/'.$this->controller.'.php';
		if (file_exists($file)) {
			require_once $file;
		} elseif($file == $this->root.APPPATH.'mvc/controllers/.php') {
			require_once $this->root.APPPATH.'mvc/controllers/'.$this->indexPage.'.php';
		} else {
			self::error('404', '404 Страница не найдена');
			die();
		}
	}


	/**
	 * Загружаем вид.
	 *
	 * @example $this->loadView('index');
	 *
	 * @var $name: string - имя файла вида или путь и имя относительно каталога с видами
	 *
	 */
	private function loadView($name = '') {
		$file = $this->root.APPPATH.'mvc/views/pages/'.$name.'.php';
		$layout = $this->root.APPPATH.'mvc/views/layout/'.$this->layout.'.php';
		if (file_exists($file)) {
			ob_start(); // Буферизация - для вывода php в файлах шаблона
			if ($this->data) { // Создание переменных, где название переменной = ключ
				foreach ($this->data as $key => $value) {
					$$key = $value;
				}
			}
			require_once $file;
			$this->data['content'] = ob_get_contents();
			ob_end_clean();
			if ($this->data) { // Создание переменных, где название переменной = ключ
				foreach ($this->data as $key => $value) {
					$$key = $value;
				}
			}
			if (file_exists($layout)) {
				require_once $layout; // Подключаем файл шаблона
			} else {
				self::error('general', 'Ошибка загрузки шаблона '.$this->layout);
				die();
			}
		} else {
			self::error('general', 'Ошибка загрузки вида '.$name);
			die();
		}
	}


	/**
	 * Загружаем хелпер.
	 *
	 * @example $this->loadHelper('helper');
	 * @example $this->loadHelper(array('helper1', 'helper2'));
	 *
	 * @var $name: string или array - имя хелпера (например, test), файл будет - testHelper.php 
	 *
	 */
	private function loadHelper($name) {
		if (is_array($name)) {
			foreach ($name as $key => $value) {
				$file = $this->root.APPPATH.'/helpers/'.$value.'.php';
				if (file_exists($file)) {
					require_once $file;
				} else {
					self::error('general', 'Ошибка загрузки хелпера '.$value);
					die();
				}
			}
		} else {
			$file = $this->root.APPPATH.'/helpers/'.$name.'Helper.php';
			if (file_exists($file)) {
				require_once $file;
			} else {
				self::error('general', 'Ошибка загрузки хелпера '.$name);
				die();
			}
		}
	}


	/**
	 * Подключаем базу данных. Включить/отключить базу данных можно в конфиге.
	 *
	 */
	private function database() {
		if ($this->db) { // Если включена работа с базой
			require_once $this->root.'/system/ActiveRecord.php'; // Подключаем ActiveRecord.php (phpactiverecord.org)
			ActiveRecord\Config::initialize(function($cfg) {
				$cfg->set_model_directory($this->root.APPPATH.'/models/');
				$cfg->set_connections(array('development' => 'mysql://'.$this->user.':'.$this->password.'@'.$this->host.'/'.$this->database.'?charset=utf8'));
			});
		}
	}


	/**
	 * Получаем имя контроллера.
	 *
	 * @example $url = /index/?id=123&test=3 => index
	 *
	 * @var $url: string - текущий url адрес
	 *
	 * @var $trim: boolean - удалять ли слэши
	 *
	 */
	private function separate($url, $trim = true) {
		return ($trim) ? preg_replace('/\\/.*/','', trim($url, '/')) : preg_replace('/\\/.*/','', $url);
	}


	/**
	 * Выводим сообщение об ошибке.
	 *
	 * @var $error: string - имя файла ошибки (404, general) 
	 *
	 */
	private function error($error = '404', $data = ''){
		$errorFile = $this->root.APPPATH.'mvc/views/errors/'.$error.'.php';
		if (file_exists($errorFile)) {
			require_once $errorFile;
			die();
		} else {
			$data = 'Ошибка. Не существует файла ошибки.';
			require_once $this->root.APPPATH.'mvc/views/errors/general.php';
		}
	}


	/**
	 * Загружаем класс (стороннюю библиотеку)
	 *
	 * @example $test = $this->loadLibrary('test', 'libraries', 'MY_', '');
	 *          $test->test();
	 *			$test = $this->loadLibrary('test', 'libraries', 'MY_', '');
	 *			$test->test();
	 *			class MY_test {
	 *				function __construct() {
	 *				}
	 *				public function test() {
	 *					echo 123;
 	 *				}
 	 *			}
 	 *
	 * @var $class: string - название загружаемого класса
	 *
	 * @var $directory: string - директория с классом (/SYSPATH/libraries или /SYSPATH/classes или /APPPATH/libraries или /APPPATH/classes)
	 * 
	 * @var $prefix: string - префикс класса (class MY_test {})
	 *
	 * @var $params: string - передаваемые параметры для конструктора
	 *
	 */
	private function loadLibrary($class, $directory = 'libraries', $prefix = '', $params = '') {
		static $classes = array();
		if (isset($classes[$class])) {
			return $classes[$class];
		}
		$name = FALSE;
		foreach (array(APPPATH, SYSPATH) as $path) {
			if (file_exists($this->root.$path.$directory.'/'.strtolower($class).'.php')) {
				$name = $prefix.$class;
				if (class_exists($name) === FALSE) {
					require($this->root.$path.$directory.'/'.strtolower($class).'.php');
				}
				break;
			}
		}
		if ($name === FALSE) {
			exit('Невозможно найти библиотеку: '.$class.'.php');
		}
		self::isLoaded($class);
		$classes[$class] = new $name($params);
		return $classes[$class];
	}


	/**
	 * Проверяем, загружен ли класс
	 *
	 * @var $class: string - имя класса
	 *
	 */
	private function isLoaded($class = '') {
		static $isLoaded = array();
		if ($class != '') {
			$isLoaded[strtolower($class)] = $class;
		}
		return $isLoaded;
	}


	/**
	 * Подключаем файл автозагрузки классов, хелперов итд
	 *
	 */
	private function autoload() {
		require_once $this->root.APPPATH.'/config/autoload.php';
	}
}
?>
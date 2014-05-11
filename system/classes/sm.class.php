<?
class SM {
	
	public static $data;
	public static $helper;

	function __construct() {
		require_once APPPATH.'mvc/controllers/application.ctrl.php';
		$this->setController();
		$this->loadView(Config::$indexPage);
	}

	public function setController() {
		$segment    = (!Router::getUriSegment(1)) ? (Config::$indexPage) : (Router::getUriSegment(1));
		$controller = APPPATH.'mvc/controllers/'.$segment.'.ctrl.php';
		if (file_exists($controller))
			require_once $controller;
		else
			Error::show404();
	}

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

	public function loadLibrary($class, $params = '') {
		$class = new $class($params);
		return $class;
	}

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
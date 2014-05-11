<?
class Application {

	public function __construct() {
		if (Config::$db) {
			require_once SYSPATH.'ActiveRecord/ActiveRecord.php';
			new Database();
		}
		new SM();
	}

}
?>
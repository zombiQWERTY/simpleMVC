<?
class Error {

	public function show404() {
		Exceptions::show404();
		exit;
	}

	public function showError($message, $statusCode = 500, $heading = 'Произошла ошибка') {
		echo Exceptions::showError($heading, $message, 'errorGeneral', $statusCode);
		exit;
	}
	
}
?>
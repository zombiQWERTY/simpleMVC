<?
try {
	$this->autoload['Lessc']->compileFile($this->root.'/assets/styles/app.less', $this->root.'/assets/styles/style.css');
} catch (exception $e) {
	echo 'Ошибка сборки CSS: '.$e->getMessage();
}
?>
<?
try {
	SM::$helper['lessc']->compileFile(ROOT.'/assets/styles/app.less', ROOT.'/assets/styles/style.css');
} catch (exception $e) {
	echo 'Ошибка сборки CSS: '.$e->getMessage();
}
?>
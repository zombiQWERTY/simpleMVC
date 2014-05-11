<?
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'Russian_Russia.65001');

define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST']);
define('ROOT'    , $_SERVER['DOCUMENT_ROOT']);
define('APPPATH' , ROOT.'/application/');
define('SYSPATH' , ROOT.'/system/');

require_once SYSPATH.'autoload.php';

require_once SYSPATH.'exceptionHandler.php';

set_error_handler('exceptionHandler');

if (!Common::isPhp('5.3')) @set_magic_quotes_runtime(0);

new Application();
?>
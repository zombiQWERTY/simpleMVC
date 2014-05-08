<?
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'Russian_Russia.65001');

define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST']);
define('ROOT'    , $_SERVER['DOCUMENT_ROOT']);
define('APPPATH' , ROOT.'/application/');
define('SYSPATH' , ROOT.'/system/');

require_once SYSPATH.'autoload.php';

new Application();
?>
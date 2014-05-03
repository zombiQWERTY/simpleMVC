<?
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'Russian_Russia.65001');

define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST']);
define('APPPATH', '/application/');
define('SYSPATH', '/system/');

require_once $_SERVER['DOCUMENT_ROOT'].APPPATH.'config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].SYSPATH.'application.php';
new Application;
?>
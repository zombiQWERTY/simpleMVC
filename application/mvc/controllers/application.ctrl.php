<?
SM::$data['menu'] = Menu::all();
SM::$data['controller'] = Router::getUriSegments()[0];
if (count(Router::getUriSegments()) == 2) {
	SM::$data['projectId'] = Router::getUriSegments()[1];
} else {
	SM::$data['projectId'] = null;
}
?>
<?
SM::$data['title'] = 'Портфолио';

$segments = Router::getUriSegments();
if (count($segments) == 2) {
	SM::$data['project'] = Project::find_by_id($segments[1]);
	if (SM::$data['project']) {
		SM::$data['title'] = SM::$data['project']->title;
		SM::$data['pictures'] = Picture::find('all', array(
			'conditions' => array('project_id=?', $segments[1]),
			'conditions' => array('preview=?', 0)
		));
		SM::loadView('project');
	} else {
		Error::show404();
	}
} else {
	SM::$data['projects'] = Project::all();
	SM::$data['pictures'] = Picture::find('all', array(
		'conditions' => array('preview=?', 1)
	));
	SM::loadView('portfolio');
}
?>